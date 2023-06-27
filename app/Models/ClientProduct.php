<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProduct extends Model
{
    use HasFactory;

    protected $table = 'client_products';

    protected $fillable = [
        'id_user',
        'id_produit'
    ];


    public function ProductDetails()
    {
        return $this->hasMany(Produit::class,'id_produit','id_produit');
    }
}
