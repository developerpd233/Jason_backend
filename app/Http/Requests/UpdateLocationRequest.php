<?php

namespace App\Http\Requests;

use App\Models\Location;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLocationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('location_edit');
    }

    public function rules()
    {
        return [
            'location' => [
                'string',
                'required',
                'unique:locations,location,' . request()->route('location')->id,
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
