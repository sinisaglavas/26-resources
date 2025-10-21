<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NewShipmentRequest extends FormRequest
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
            'details' => 'required|string|max:1000',
            'documents' => 'required|array', // da bi radili validaciju za svaki dokument u nizu potreban je jos jedan red ispod
            'document.*' => 'file|mimes:jpg,jpeg,png,webp,pdf,doc,docx|max:10240', // document.* se odnosi na svaki element u nizu
        ];
    }
}
