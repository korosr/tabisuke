<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
     *htmlspecialchars
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required',
            'time' => 'required',
            'plan_title' => 'required|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'date' => '日付',
            'time' => '時間',
            'plan_title' => 'プランタイトル',
        ];
    }

    public function messages(){

        return [
            'date.required' => '日付は必ず入力してください。',
            'time.required' => '時間は必ず入力してください。',
            'plan_title.required' => 'プランタイトルは必ず入力してください。',
            'plan_title.max' => 'プランタイトルは100文字以内で入力してください。',
        ];
    }
}
