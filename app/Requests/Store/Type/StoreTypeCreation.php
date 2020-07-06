<?php


namespace App\Requests\Store\Type;


use Illuminate\Foundation\Http\FormRequest;

class StoreTypeCreation extends FormRequest
{
    public function authorization(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type_name' => 'required|max:255'
        ];
    }
}
