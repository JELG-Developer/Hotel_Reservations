<?php

namespace App\Models;

use App\Models\Bedrom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    public function bedrom(){
        return $this->belongsTo(Bedrom::class);        
    }
    protected $fillable = [
        'name',
        'description',
    ];
}
