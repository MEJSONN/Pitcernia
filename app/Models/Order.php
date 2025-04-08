<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'address', 'items', 'total_price'];

    protected $casts = [
        'items' => 'array',
    ];

    // Relacja do użytkownika
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Accessor: złożony adres z users.city, users.street, users.house_number
    public function getAddressAttribute($value)
    {
        if ($value) {
            return $value;
        }

        $user = $this->user;

        if (!$user) {
            return null;
        }

        return "{$user->city}, {$user->street} {$user->house_number}";
    }
}
