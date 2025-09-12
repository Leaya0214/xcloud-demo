<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // database/migrations/xxxx_create_servers_table.php
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('ip_address', 15);
            $table->enum('provider', ['aws', 'digitalocean', 'vultr', 'other']);
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->unsignedTinyInteger('cpu_cores');
            $table->unsignedInteger('ram_mb');
            $table->unsignedBigInteger('storage_gb');
            $table->unsignedInteger('version')->default(1);
            $table->timestamps();

            $table->unique(['provider', 'name'], 'uq_provider_name');
            $table->unique('ip_address', 'uq_ip_address');

            $table->index('provider');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
