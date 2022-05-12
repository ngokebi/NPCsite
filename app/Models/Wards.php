<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lga_id',
        'state_id'
    ];

    public function lgas() {
        return $this->belongsTo(Lga::class, 'lga_id', 'id');
    }

    public function states() {
        return $this->belongsTo(States::class, 'state_id', 'id');
    }
}
