<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreClubsRequest extends FormRequest
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
            'club_name' => 'required',
            'club_description' => 'required',
            'club_timetable' => 'required',
            'club_logo' => 'mimes:png,jpg,jpeg,gif|required',
            'user_id' => 'required',
            'category_id' => 'required',
        ];
    }
}
