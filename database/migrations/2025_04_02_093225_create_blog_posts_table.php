<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('blog_posts')) {
            Schema::create('blog_posts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('blog_category_id')->constrained()->onDelete('cascade');
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('content');
                $table->string('thumbnail')->nullable();
                $table->boolean('is_published')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
