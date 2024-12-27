<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoundingModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'roundings',
        'distribution_model_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'distribution_model_id',
    ];

    public function distributionModel(): BelongsTo
    {
        return $this->belongsTo(DistributionModel::class);
    }

    protected function casts(): array
    {
        return [
            'roundings' => 'array',
        ];
    }
}
