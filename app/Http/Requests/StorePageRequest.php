<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:page|min:5',
            'content' => 'required',

        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Tiêt đề bài viết bắt buộc phải nhập',
            'content.required' => 'Từ khoá bắt buộc phải nhập',

        ];
    }
}