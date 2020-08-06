<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

class CatalogueProductFloat extends Model
{
    protected $fillable = [
        'price',
        'special_price',
        'buying_price'
    ];
}
