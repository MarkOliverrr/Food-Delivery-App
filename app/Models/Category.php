<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'res_categories';
    protected $primaryKey = 'c_id';
    public $timestamps = true;

    protected $fillable = [
        'c_name',
    ];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'c_id');
    }
}

