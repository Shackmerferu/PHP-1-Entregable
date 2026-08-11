<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoItem extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'cantidad',
        'producto_id',
        'user_id'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }


    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}