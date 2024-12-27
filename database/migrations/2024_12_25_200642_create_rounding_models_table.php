<?php

use App\Models\DistributionModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rounding_models', function (Blueprint $table) {
            $table->id();
            $table->float('total');
            $table->json('roundings');
            $table->foreignIdFor(DistributionModel::class)->constrained('distribution_models');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rounding_models');
    }
};
