<?php


namespace App\Requests\User\Role;


use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorization(): bool
    {
        return true;
    }

    /**
     * @return array|string[]
     */
    public function rules(): array
    {
        return [
          'role' => 'required|max:255'
        ];
    }
}
