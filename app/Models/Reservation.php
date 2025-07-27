<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Copy;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'copy_id',
        'reserved_at',
        'status',
        // altri campi se ci sono
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function copy() {
        return $this->belongsTo(Copy::class);
    }

}
