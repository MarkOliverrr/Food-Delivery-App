<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

    protected $table = 'remarks';
    public $timestamps = false;

    protected $fillable = [
        'frm_id',
        'status',
        'remark',
        'remarkDate',
    ];

    protected $casts = [
        'remarkDate' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'frm_id', 'o_id');
    }
}

