<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizens extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'address',
        'phone',
        'ward_id',
        'state_id',
        'lga_id'
    ];

    public function wards() {
        return $this->belongsTo(Wards::class, 'ward_id', 'id');
    }

    public function lgas() {
        return $this->belongsTo(Lga::class, 'lga_id', 'id');
    }

    public function states() {
        return $this->belongsTo(States::class, 'state_id', 'id');
    }

}
