<?php

namespace App\Http\Requests;

use App\Rules\UserClient;
use Illuminate\Foundation\Http\FormRequest;

class NewShipmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:128',
            'fromCity' => 'required|string|max:64',
            'fromCountry' => 'required|string|max:64',
            'toCity' => 'required|string|max:64',
            'toCountry' => 'required|string|max:64',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:in_progress,unassigned,completed,problem',
            'details' => 'required|string|max:1000',
            'documents' => 'required|array',
            'documents.*' => 'file|mimes:jpg,jpeg,png,webp,pdf,doc,docx|max:10240',
            'clientId' => ['required', new UserClient()],
        ];
    }
}
