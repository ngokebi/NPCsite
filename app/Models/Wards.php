<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lga_id'
    ];

    public function lga() {
        return $this->belongsTo(Lga::class, 'lga_id', 'id');
    }
}
