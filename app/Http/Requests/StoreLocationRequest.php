<?php

namespace App\Http\Requests;

use App\Models\Location;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLocationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('location_create');
    }

    public function rules()
    {
        return [
            'location' => [
                'string',
                'required',
                'unique:locations',
            ],
            'qr_codes.*' => [
                'integer',
            ],
            'qr_codes' => [
                'required',
                'array',
            ],
        ];
    }
}
