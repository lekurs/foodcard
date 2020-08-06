<?php


namespace App\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class UserCreationRequest extends FormRequest
{
    public function authorization(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userid' => '',
            'username' => 'required|max:255',
            'lastname' => 'required|max:255',
            'user-fonction' => 'required',
            'email' => 'max:255',
            'user-phone' => '',
            'password' => 'max:255',
        ];
    }
}
