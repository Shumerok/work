<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'photo' => 'required|image|mimes:png,jpg|max:5120|dimensions:min_width=300,min_height=300',
//            'name'=> 'required|string|min:2|max:256|regex:/^[a-zA-Z\s]*$/',
            'name'=> 'required|string|min:2|max:256|',
            'phone'=> 'required|regex:/^\+380 \([50,93,67]{2}\) [0-9]{3} [0-9]{2} [0-9]{2}$/i',
            'email'=> 'required|string|email|max:255|',
            'position_id'=>'required|integer|exists:positions,id',
            'salary' => 'required|decimal:0,500',
            'head'=>'required|integer|exists:employers,id',
            'date_employment'=> 'required|date:d/m/Y',
            'admin_updated_id'=>'required|integer|exists:users,id',
        ];
    }
}
