<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatesRequest extends FormRequest
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
            'update_title' => 'required',
            'update_body' => 'required',
            'update_image' => 'mimes:png,jpg,jpeg,gif|required',
            'user_id' => 'required',
            'club_id' => 'required',
        ];
    }
}
