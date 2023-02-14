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
            'photo' => 'nullable|image|mimes:png,jpg|max:5120|dimensions:min_width=300,min_height=300',
            'name' => 'required|string|min:2|max:256|',
            'phone' => 'required|regex:/^\+380 \([50,66,95,99,67,68,96,97,98,63,73,93]{2}\) [0-9]{3} [0-9]{2} [0-9]{2}$/i',
            'email' => 'required|string|email|max:255|',
            'position_id' => 'nullable|integer|exists:positions,id',
            'salary' => 'required|numeric|between:0,500',
            'head' => 'nullable|integer|exists:employers,id',
            'date_employment' => 'required|date:d/m/Y',
            'admin_updated_id' => 'required|integer|exists:users,id'
        ];
    }

    protected function prepareForValidation()
    {
        $floatSalary = (float)str_replace(',', '.', $this->salary);
        $this->merge([
            'salary' => $floatSalary,
        ]);
    }
}
