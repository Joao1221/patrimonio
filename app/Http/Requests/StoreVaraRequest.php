<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVaraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cidade_comarca_id' => ['required', 'exists:cidades_comarcas,id'],
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('varas', 'nome')->where(fn ($query) => $query->where('cidade_comarca_id', $this->input('cidade_comarca_id'))),
            ],
            'ativo' => ['sometimes', 'boolean'],
        ];
    }
}
