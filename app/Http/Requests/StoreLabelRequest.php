<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entityType' => ['string', 'required'],
            'entityId' => ['integer', 'required'],
            'labels' => ['array', 'required']
        ];
    }

    public function messages(): array
    {
        return [
            'entityType' => 'Параметр "Тип сущности" обязателен',
            'entityId' => 'Параметр "Идентификатор сущности" обязателен',
            'labels' => 'Параметр "Лейблы" обязателен'
        ];
    }
}
