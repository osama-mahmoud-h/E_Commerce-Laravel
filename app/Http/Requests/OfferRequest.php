<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
    public function rules(){
        return [
            'name'=>'required|max:100',
            'photo'=>'max:150|mimes:mimes:jpg,jpeg,png,svg',
            'details'=>'required|max:350',
        ];
    }

    public function messages(){
        return [
            'required'=>'هذا الحقل مطلوب',
            'max'=>'هذا الحقل طويل جدا',
            'unique'=>'هذا الحقل موجود من  قبل ',
        ];
    }
}
