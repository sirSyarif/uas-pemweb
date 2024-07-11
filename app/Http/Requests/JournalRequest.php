<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return
        [
            'title' => 'required',
            'author' => 'required',
            'publication_date' => 'required',
            'abstract' => 'required',
            'category_id' => 'required',
            // 'file' => 'required|mimes:pdf',
        ];
    }
}
