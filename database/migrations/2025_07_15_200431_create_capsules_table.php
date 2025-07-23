<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('capsules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->string('title')->nullable();
            $table->text('message');
            $table->dateTime('reveal_date');
            $table->enum('privacy_setting', ['private', 'public', 'unlisted']);
            $table->decimal('gps_latitude', 10, 8)->nullable();
            $table->decimal('gps_longitude', 11, 8)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('location');
            $table->boolean('is_revealed')->default(false);

            $table->string('custom_color', 7)->nullable();
            $table->string('custom_emoji', 10)->nullable();

            $table->string('cover_image_url')->nullable();
            $table->string('media_image_url')->nullable();
            $table->string('audio_file_url')->nullable();
            $table->longText('text_note')->nullable();

            $table->boolean('surprise_mode')->default(false);
            $table->string('mood')->nullable();
            $table->string('unlisted_link_token')->unique()->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('capsules');
    }
};
