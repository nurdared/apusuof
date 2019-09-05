<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
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
            
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->route('user'),
            'role_id' => 'required',
            'username' => 'required',
            'contact' => 'min:8|max:18|nullable',
            'age' => 'nullable|date_format:'.config('app.date_format'),
        ];
    }
}
