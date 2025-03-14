<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'latitude', 'longitude']; // Sesuaikan dengan kolom tabel

    public static $rules = [
        'name' => 'required|string|max:255',
        'longitude' => 'required|numeric',
        'latitude' => 'required|numeric',
    ];
}
