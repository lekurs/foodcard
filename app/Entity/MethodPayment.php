<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

class MethodPayment extends Model
{
    protected $fillable = [
        'method'
    ];

    public $timestamps = false;


}
