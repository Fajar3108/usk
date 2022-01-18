<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['created_by', 'name', 'slug', 'description', 'price', 'image'];

    public function seller()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
