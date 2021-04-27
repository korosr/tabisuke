<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuideRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'sub_title' => 'max:100',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'sub_title' => 'サブタイトル',
        ];
    }

    public function messages(){

        return [
            'title.required' => 'タイトルは必ず入力してください。',
            'title.max' => 'タイトルは100文字以内で入力してください。',
            'sub_title.max' => 'サブタイトルは100文字以内で入力してください。',
        ];
    }
}