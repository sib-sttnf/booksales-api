<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 */
class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = ['name', 'photo', 'bio'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
