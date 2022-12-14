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
                'unique:users,name,' . request()->route('user')->id,
            ],
            // 'email' => [
            //     'required',
            //     'unique:users,email,' . request()->route('user')->id,
            // ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
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
        ];
    }
}
