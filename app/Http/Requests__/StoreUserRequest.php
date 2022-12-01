<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:users,name',
            ],
            // 'email' => [
            //     'required',
            //     'unique:users',
            // ],
            // 'password' => [
            //     'required',
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
