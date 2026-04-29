<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}
