<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'merchandise_id',
        'quantity',
        'total_price',
        'name',
        'phone',
        'address',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    // Order milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order milik satu merchandise
    public function merchandise()
    {
        return $this->belongsTo(Merchandise::class);
    }
}