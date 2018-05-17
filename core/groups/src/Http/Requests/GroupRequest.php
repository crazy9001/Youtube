<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/17/2018
 * Time: 6:57 PM
 */

namespace Youtube\Groups\Http\Requests;

use Youtube\Base\Http\Requests\Request;

class GroupRequest extends Request
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
            'name'  =>  'required',
            'tags' => 'required',
        ];
    }

    public function messages(){

        $messages = array(
            'name.required' => 'Chưa nhập tên nhóm',
            'tags.required' => 'Chưa nhập tags nhóm',
        );

        return $messages;
    }
}