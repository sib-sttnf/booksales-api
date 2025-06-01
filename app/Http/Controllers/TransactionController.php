<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // READ ALL - Hanya Admin
    public function index()
    {
        try {
            $transactions = Transaction::with(['customer:id,name,email', 'book:id,title,price'])
                                     ->orderBy('created_at', 'desc')
                                     ->get();

            return response()->json([
                'success' => true,
                'message' => 'Data transaksi berhasil diambil',
                'data' => $transactions
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // CREATE - Customer terautentikasi
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $user = auth('api')->user();
            $book = Book::find($request->book_id);

            // Cek stok
            if ($book->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok buku tidak mencukupi'
                ], 400);
            }

            // Generate order number
            $orderNumber = 'ORD-' . strtoupper(uniqid());

            // Hitung total
            $totalAmount = $book->price * $request->quantity;

            // Create transaction
            $transaction = Transaction::create([
                'order_number' => $orderNumber,
                'customer_id' => $user->id,
                'book_id' => $request->book_id,
                'quantity' => $request->quantity,
                'total_amount' => $totalAmount,
                'notes' => $request->notes
            ]);

            // Update stok buku
            $book->decrement('stock', $request->quantity);

            DB::commit();

            // Load relasi untuk response
            $transaction->load(['customer:id,name,email', 'book:id,title,price']);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat',
                'data' => $transaction
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // SHOW - Customer terautentikasi (hanya transaksi milik sendiri)
    public function show($id)
    {
        try {
            $user = auth('api')->user();
            
            $transaction = Transaction::with(['customer:id,name,email', 'book:id,title,price,stock'])
                                    ->where('id', $id)
                                    ->where('customer_id', $user->id)
                                    ->first();

            if (!$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan atau bukan milik Anda'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail transaksi',
                'data' => $transaction
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // UPDATE - Customer terautentikasi (hanya status dan notes)
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'sometimes|in:pending,completed,cancelled',
            'notes' => 'sometimes|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = auth('api')->user();
            
            $transaction = Transaction::where('id', $id)
                                    ->where('customer_id', $user->id)
                                    ->first();

            if (!$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan atau bukan milik Anda'
                ], 404);
            }

            // Hanya update field yang diizinkan
            $transaction->update($request->only(['status', 'notes']));
            
            $transaction->load(['customer:id,name,email', 'book:id,title,price']);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil diupdate',
                'data' => $transaction
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // DESTROY - Hanya Admin
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $transaction = Transaction::find($id);

            if (!$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404);
            }

            // Kembalikan stok jika transaksi belum completed
            if ($transaction->status !== 'completed') {
                $book = Book::find($transaction->book_id);
                if ($book) {
                    $book->increment('stock', $transaction->quantity);
                }
            }

            $transaction->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}