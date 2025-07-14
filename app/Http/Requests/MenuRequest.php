<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:menus,name',
            'url' => 'required|unique:menus,url',
            'icon' => 'required',
            'type' => 'required',
            'parent' => 'nullable',
        ];
    }
}
