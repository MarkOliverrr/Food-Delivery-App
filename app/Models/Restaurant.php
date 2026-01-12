<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurants';
    protected $primaryKey = 'rs_id';
    public $timestamps = true;

    protected $fillable = [
        'c_id',
        'title',
        'email',
        'phone',
        'url',
        'o_hr',
        'c_hr',
        'o_days',
        'address',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'c_id');
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class, 'rs_id');
    }
}

