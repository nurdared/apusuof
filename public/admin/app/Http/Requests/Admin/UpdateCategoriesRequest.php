<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriesRequest extends FormRequest
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
            
            'category_name' => 'min:4|required',
            'category_body' => 'required',
            'user_id' => 'required',
            'category_image' => 'nullable|mimes:png,jpg,jpeg,gif',
        ];
    }
}
