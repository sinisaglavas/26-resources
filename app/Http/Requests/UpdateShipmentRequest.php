<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShipmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:128',
            'from_city' => 'required|string|max:64',
            'from_country' => 'required|string|max:64',
            'to_city' => 'required|string|max:64',
            'to_country' => 'required|string|max:64',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:in_progress,unassigned,completed,problem',
            'user_id' => 'required|integer|exists:users,id',
            'details' => 'required|string|max:1000',
        ];
    }
}
