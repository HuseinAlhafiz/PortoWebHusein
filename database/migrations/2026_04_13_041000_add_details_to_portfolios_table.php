<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('github_link')->nullable()->after('link');
            $table->json('features')->nullable()->after('github_link');
            $table->json('tech_stack')->nullable()->after('features');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['github_link', 'features', 'tech_stack']);
        });
    }
};
