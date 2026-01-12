<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'users_orders';
    protected $primaryKey = 'o_id';
    public $timestamps = true;

    protected $fillable = [
        'u_id',
        'title',
        'quantity',
        'price',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'u_id');
    }

    public function remark()
    {
        return $this->hasOne(Remark::class, 'frm_id', 'o_id');
    }
}

