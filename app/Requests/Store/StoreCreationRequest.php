<?php


namespace App\Requests\Store;


use Illuminate\Foundation\Http\FormRequest;

class StoreCreationRequest extends FormRequest
{
    public function authorization(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => '',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'address_complement' => '',
            'zip' => 'required|max:5',
            'city' => 'required|max:255',
            'phone' => 'max:10',
            'tva' => '',
            'siren' => 'required',
            'storetype' => 'required',
            'main' => '',
            'storelogo' => '',
            'storeillustration' => '',
        ];
    }
}
