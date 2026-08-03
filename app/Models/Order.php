<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'order_source', 'customer_name', 'customer_wa', 'customer_address',
        'items', 'subtotal', 'shipping_cost', 'grand_total',
        'payment_method', 'payment_status', 'status',
        'courier', 'tracking_number', 'notes',
    ];

    protected $casts = [
        'items' => 'array',
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];
}
