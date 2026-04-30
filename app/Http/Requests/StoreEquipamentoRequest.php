<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEquipamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_equipamento_id' => ['required', 'exists:tipos_equipamento,id'],
            'codigo_patrimonio' => ['required', 'string', 'max:255', 'unique:equipamentos,codigo_patrimonio'],
            'marca_id' => ['nullable', 'exists:marcas,id'],
            'modelo' => ['nullable', 'string', 'max:150'],
            'cidade_comarca_id' => ['required', 'exists:cidades_comarcas,id'],
            'vara_id' => ['nullable', 'exists:varas,id'],
            'setor_id' => ['nullable', 'exists:setores,id'],
            'observacoes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'tipo_equipamento_id.required' => 'O campo tipo de equipamento é obrigatório.',
            'tipo_equipamento_id.exists' => 'O tipo de equipamento selecionado é inválido.',
            'codigo_patrimonio.required' => 'O campo código patrimônio é obrigatório.',
            'codigo_patrimonio.unique' => 'O código patrimônio já está em uso.',
            'codigo_patrimonio.max' => 'O código patrimônio não pode ter mais de :max caracteres.',
            'marca_id.exists' => 'A marca selecionada é inválida.',
            'modelo.max' => 'O modelo não pode ter mais de :max caracteres.',
            'cidade_comarca_id.required' => 'O campo cidade/comarca é obrigatório.',
            'cidade_comarca_id.exists' => 'A cidade/comarca selecionada é inválida.',
            'vara_id.exists' => 'A vara selecionada é inválida.',
            'setor_id.exists' => 'O setor selecionado é inválido.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->redirectToRoute('equipamentos.create')
            ->withErrors($validator)
            ->withInput());
    }
}