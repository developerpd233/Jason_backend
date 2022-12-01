<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            // 'locations.*' => [
            //     'integer',
            // ],
            // 'locations' => [
            //     'array',
            // ],
            'interest' => [
                'required',
            ],
            'age' => [
                'required',
            ],
            'relationPreference' => [
                'required',
            ],
            'favDrink' => [
                'string',
                'required',
            ],
            'favSong' => [
                'string',
                'required',
            ],
            'hobbies' => [
                'string',
                'required',
            ],
            'petPeeve' => [
                'string',
                'required',
            ],
            'user_status' => [
                'required',
            ],
        ];
    }
}
