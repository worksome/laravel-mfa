<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mfa_multi_factors', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('to');
            $table->string('channel');
            $table->string('status');
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();

            $table->unique(['to', 'channel']);
        });
    }

    public function down(): void
    {
        Schema::drop('mfa_multi_factors');
    }
};
