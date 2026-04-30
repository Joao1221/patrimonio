<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLevantamentoEquipamentoRequest extends StoreEquipamentoRequest
{
    public function rules(): array
    {
        return [
            'tipo_equipamento_id' => ['required', 'exists:tipos_equipamento,id'],
            'codigo_patrimonio' => ['required', 'regex:/^[0-9]{1,6}$/', 'min:1'],
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
        return array_merge(parent::messages(), [
            'codigo_patrimonio.required' => 'O campo código patrimônio é obrigatório.',
            'codigo_patrimonio.regex' => 'O código patrimônio deve ter de 1 a 6 dígitos.',
            'codigo_patrimonio.min' => 'O código patrimônio deve ser um número positivo.',
            'codigo_patrimonio.max' => 'O código patrimônio deve ter no máximo 6 dígitos.',
        ]);
    }

    protected function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $codigo = $this->input('codigo_patrimonio');
            $equipamento = \App\Models\Equipamento::with('cidadeComarca')
                ->where('codigo_patrimonio', $codigo)
                ->first();

            if ($equipamento) {
                $cidadeNome = $equipamento->cidadeComarca?->nome ?? 'Desconhecida';
                $validator->errors()->add(
                    'codigo_patrimonio',
                    "O código patrimônio já está em uso na cidade: {$cidadeNome}."
                );
            }
        });
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->redirectToRoute('equipamentos.levantamento')
            ->withErrors($validator)
            ->withInput());
    }
}
