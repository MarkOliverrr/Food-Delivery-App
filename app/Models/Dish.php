<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $table = 'dishes';
    protected $primaryKey = 'd_id';
    public $timestamps = true;

    protected $fillable = [
        'rs_id',
        'title',
        'slogan',
        'price',
        'img',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'rs_id');
    }
}

