<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Book;

class Copy extends Model
{
    protected $fillable = ['book_id', 'barcode', 'status', 'location','condition', 'notes'];
    //
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reservation()
    {
        return $this->hasMany(Booking::class);
    }
}
