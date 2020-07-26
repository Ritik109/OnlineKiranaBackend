<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserPost extends FormRequest
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
                'firstname'=> 'required',
                'lastname'=>'required',
                'email'=>'required|unique:users,email',
                'password'=>'required',
                'phone'=>'required|unique:users,phone'
            ];
    }
    
}
