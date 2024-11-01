<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'description'        
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function bookUsers()
    {
        return $this->hasMany(Book_User::class);
    }
}
