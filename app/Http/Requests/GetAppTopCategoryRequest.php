<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class GetAppTopCategoryRequest extends FormRequest
{
    public function getDate(): Carbon
    {
        return Carbon::parse($this->input('date'));
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', Rule::date()->format('Y-m-d')],
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'Укажите дату',
            'date.date_format' => 'Неверный формат даты, пример: 2025-09-28',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseHelper::error(errors: $validator->errors()->toArray()));
    }
}
