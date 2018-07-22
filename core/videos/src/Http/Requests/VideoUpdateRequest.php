<?php
/**
 * Created by PhpStorm.
 * User: PTG
 * Date: 7/22/2018
 * Time: 1:14 PM
 */

namespace Youtube\Videos\Http\Requests;

use Youtube\Base\Http\Requests\Request;

class VideoUpdateRequest extends Request
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
            'video_title'  =>  'required',
        ];
    }

    public function messages(){

        $messages = array(
            'video_title.required' => 'Vui lòng nhập tiêu đề video',
        );

        return $messages;
    }
}