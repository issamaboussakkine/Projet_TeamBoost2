<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('mood', ['super', 'bien', 'neutre', 'fatigue', 'stresse']);
            $table->text('what_i_did_yesterday')->nullable();
            $table->text('what_i_will_do_today');
            $table->text('blockers')->nullable();
            $table->date('checkin_date');
            $table->timestamps();
            
            $table->unique(['user_id', 'checkin_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('check_ins');
    }
};