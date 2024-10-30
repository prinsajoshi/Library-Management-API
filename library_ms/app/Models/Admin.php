<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    use HasFactory;
    protected $table='admins';
    protected $fillable=['username','password','role','token','email'];

    public function bookUsers()
    {
        return $this->hasMany(Book_User::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
