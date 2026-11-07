<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // One row: everything editable on the homepage that is not a list.
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();

            // Announcement bar
            $table->boolean('announcement_enabled')->default(false);
            $table->string('announcement_text')->nullable();
            $table->string('announcement_url')->nullable();

            // Hero
            $table->string('hero_badge')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_image_2')->nullable();
            $table->string('hero_primary_text')->nullable();
            $table->string('hero_primary_url')->nullable();
            $table->string('hero_secondary_text')->nullable();
            $table->string('hero_secondary_url')->nullable();
            $table->boolean('show_stats')->default(true);

            // About
            $table->string('about_heading')->nullable();
            $table->text('about_lead')->nullable();
            $table->text('about_body')->nullable();
            $table->string('about_image')->nullable();
            $table->string('about_image_2')->nullable();
            $table->json('about_highlights')->nullable();

            // Head of school
            $table->string('head_heading')->nullable();
            $table->text('head_message')->nullable();
            $table->string('head_title')->nullable();
            $table->string('head_photo')->nullable();

            // Admissions, curriculum, fees
            $table->string('admissions_heading')->nullable();
            $table->text('admissions_intro')->nullable();
            $table->json('admissions_steps')->nullable();
            $table->string('admissions_cta_text')->nullable();
            $table->string('admissions_cta_url')->nullable();
            $table->string('curriculum_heading')->nullable();
            $table->text('curriculum_text')->nullable();
            $table->string('fees_heading')->nullable();
            $table->text('fees_text')->nullable();
            $table->string('fees_cta_text')->nullable();
            $table->string('fees_cta_url')->nullable();

            // Features ("Why choose us")
            $table->string('features_heading')->nullable();

            // Anthem and pledge
            $table->boolean('show_anthem')->default(true);
            $table->string('anthem_heading')->nullable();
            $table->text('anthem_arabic')->nullable();
            $table->text('anthem_meaning')->nullable();
            $table->string('pledge_heading')->nullable();
            $table->json('pledge_items')->nullable();

            // Contact + social
            $table->string('contact_heading')->nullable();
            $table->text('contact_intro')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_whatsapp')->nullable();
            $table->string('office_hours')->nullable();
            $table->text('map_embed_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('x_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->text('footer_text')->nullable();

            $table->timestamps();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon')->default('book');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon')->default('sparkle');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->text('quote');
            $table->string('photo')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('news_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->default('news'); // news | event
            $table->date('event_date')->nullable();
            $table->string('excerpt', 300)->nullable();
            $table->text('body');
            $table->string('image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('news_posts');
        Schema::dropIfExists('gallery_items');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('features');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('homepage_settings');
    }
};
