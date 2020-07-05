<?php


namespace App\Requests\Store;


use Illuminate\Foundation\Http\FormRequest;

class StoreCreation extends FormRequest
{
    /**
     * @return bool
     */
    public function authorization(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [

        ];
    }
}
