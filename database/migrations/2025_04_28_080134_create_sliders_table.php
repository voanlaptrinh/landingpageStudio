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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Tiêu đề slider
            $table->string('subtitle')->nullable(); // Phụ đề
            $table->string('image')->nullable(); // Hình ảnh slider
            $table->string('link')->nullable(); // Liên kết nếu có
            $table->boolean('is_active')->default(true); // Trạng thái active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
