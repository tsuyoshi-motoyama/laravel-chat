<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupPost extends FormRequest
{
    /*
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /*
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:128'],
            'description' => ['required', 'max:65535'],
            'userIds' => ['required', 'array'],
            'userids,*' => ['int']
        ];
    }
}
