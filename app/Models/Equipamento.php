<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $table = 'equipamentos';

    protected $fillable = [
        'tipo_equipamento_id',
        'marca_id',
        'cidade_comarca_id',
        'vara_id',
        'setor_id',
        'codigo_patrimonio',
        'modelo',
        'observacoes',
    ];

    public function tipoEquipamento(): BelongsTo
    {
        return $this->belongsTo(TipoEquipamento::class);
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    public function cidadeComarca(): BelongsTo
    {
        return $this->belongsTo(CidadeComarca::class);
    }

    public function vara(): BelongsTo
    {
        return $this->belongsTo(Vara::class);
    }

    public function setor(): BelongsTo
    {
        return $this->belongsTo(Setor::class);
    }
}
