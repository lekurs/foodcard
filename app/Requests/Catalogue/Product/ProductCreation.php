<?php


namespace App\Requests\Catalogue\Product;


use Illuminate\Foundation\Http\FormRequest;

class ProductCreation extends FormRequest
{
    public function authorization(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_*' => 'required|max:255',
            'product_description_*' => '',
            'price' => '',
            'special_price' => '',
            'buying_price' => '',
            'allergy' => '',
            'homemade' => '',
            'category' => '',
            'store_id' => '',
            'images' => ''
        ];
    }
}
