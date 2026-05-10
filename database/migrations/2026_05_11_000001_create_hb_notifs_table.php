<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hb_notifs', function (Blueprint $table): void {
            $table->id();
            $table->string('title', 120);
            $table->string('msg', 255);
            $table->json('meta')->nullable();
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hb_notifs');
    }
};

