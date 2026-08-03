<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'bank_name', 'account_number', 'account_holder', 'icon', 'bg_color', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
