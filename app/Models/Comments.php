<?php

namespace App\Models;

use App\Models\Bokking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'bokking_id',
        'comment',
    ];    
    public function bokking()
    {
        return $this->belongsTo(Bokking::class);
    }
}
