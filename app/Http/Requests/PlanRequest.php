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
            'date_time' => '日時',
            'plan_title' => 'プランタイトル',
        ];
    }
}
