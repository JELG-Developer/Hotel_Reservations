<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bokking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entry',
        'departure',
        'amount',
        'room_id',
        'costo',
        'paymenth_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function paymenth()
    {
        return $this->belongsTo(Paymenth::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


