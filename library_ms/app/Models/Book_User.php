<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book_User extends Model
{
    use HasFactory;

    protected $table = 'book__users'; // If your table name is 'book_user'
    protected $fillable = [
        'user_id',
        'book_id',
        'taken_date',
        'submission_date',
        'reminder_date'        
    ];
    protected $hidden = ['created_at', 'updated_at'];


    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }

    public function user()
    {
        return $this->belongsTo(Admin::class,'user_id'); 
    }
}
