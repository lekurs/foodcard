<?php


namespace App\Requests\Catalogue\Category;


use Illuminate\Foundation\Http\FormRequest;

class CatalogueCategoryCreation extends FormRequest
{
    public function authorization(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
          'category' => 'required|max:255',
          'icon' => '',
          'color' => '',
          'img_path' => 'image'
        ];
    }
}
