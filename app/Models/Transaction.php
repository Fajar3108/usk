<?php

namespace App\Models;

use App\Helpers\TransactionHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'sender_id', 'receiver_id', 'confirmed_by', 'product_id', 'amount', 'type', 'status', 'description'];

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function confirm_by()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getTypeNameAttribute()
    {
        return TransactionHelper::type($this->type);
    }

    public function getStatusNameAttribute()
    {
        return TransactionHelper::status($this->status);
    }
}
