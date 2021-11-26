<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $due_date = ($this->filled(['due_date', 'due_time'])) ? $this->due_date . ' ' . $this->due_time : '';
        $this->merge([
            'due_date' => $due_date
        ]);
    }

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
            'title' => 'string|max:255|required',
            'body' => 'string|required',
            'due_date' => 'date|after:now|required',
            'reward_coin' => 'integer|multiple_of:100|max:10000|required',
            'urgent' => 'integer|min:0|max:1|required'
        ];
    }
}
