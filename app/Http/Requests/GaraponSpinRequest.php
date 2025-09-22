<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GaraponSpinRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'campaign_id' => 'required|integer|min:1',
            'spin_checkin_id' => 'sometimes|integer|min:1',
        ];
    }
}
