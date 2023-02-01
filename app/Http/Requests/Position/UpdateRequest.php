<?php

namespace App\Http\Requests\Position;

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
            'name'=> 'required|string|min:2|max:256|regex:/^[a-zA-Z\s]*$/',
            'admin_updated_id'=>'required|integer|exists:users,id',
        ];
    }
}
