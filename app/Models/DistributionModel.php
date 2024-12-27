<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @param int $id
 * @param int $amount
 * @param list<string, int> $distribution
 * @param Carbon $created_at
 * @param Carbon $updated_at
 *
 */
class DistributionModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'distribution',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function roundingModel(): HasOne
    {
        return $this->hasOne(RoundingModel::class);
    }

    protected function casts(): array
    {
        return [
            'distribution' => 'array',
        ];
    }

}
