<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Gives the new homepage a complete first version so the site looks finished
 * the moment this migration runs. Every value can be edited in the admin panel
 * under "Website". Rows are only inserted into empty tables, so re-running this
 * never overwrites the school's own edits.
 */
return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        if (DB::table('homepage_settings')->count() === 0) {
            DB::table('homepage_settings')->insert([
                'announcement_enabled' => false,
                'announcement_text'    => 'Admissions are open. Book a visit to see our classrooms.',
                'announcement_url'     => '#contact',

                'hero_badge'          => 'Admissions now open',
                'hero_title'          => 'Inspiring minds, shaping futures',
                'hero_subtitle'       => 'A caring nursery and primary school where every child discovers their potential, grows in faith and character, and learns in a supportive community.',
                'hero_primary_text'   => 'Apply for a place',
                'hero_primary_url'    => '#admissions',
                'hero_secondary_text' => 'Meet our school',
                'hero_secondary_url'  => '#about',
                'show_stats'          => true,

                'about_heading'    => 'A school that feels like family',
                'about_lead'       => 'We are committed to excellence in academics, character and community service.',
                'about_body'       => "Our goal is to nurture young minds into future leaders. Experienced teachers, a safe and inclusive environment and a strong foundation in Islamic values help every child reach their full potential.\n\nFrom their first classroom to their last day in primary school, children are known by name, encouraged to ask questions and supported to grow at their own pace.",
                'about_highlights' => json_encode([
                    ['text' => 'Children from 6 months to 10 years'],
                    ['text' => 'Montessori and Jolly Phonics in the early years'],
                    ['text' => 'Islamic values taught alongside the full curriculum'],
                    ['text' => 'School bus service for pupils'],
                ]),

                'head_heading' => 'A word from our Head of School',
                'head_message' => "Welcome to our school. Every child who joins us is a trust, and we take that trust seriously.\n\nHere, learning goes hand in hand with good character. We celebrate curiosity, teach respect and honesty, and work closely with parents so that each child feels safe, seen and ready to learn.\n\nI invite you to visit, meet our teachers and see our pupils at work.",
                'head_title'   => 'Head of School',

                'admissions_heading' => 'How to join our school',
                'admissions_intro'   => 'We welcome children of all backgrounds, aged 6 months to 10 years. Joining takes four simple steps.',
                'admissions_steps'   => json_encode([
                    ['title' => 'Make an enquiry',   'description' => 'Call, visit the school office or send us a message to ask about available places.'],
                    ['title' => 'Visit the school',  'description' => 'Tour the classrooms and meet the Head of School and our teachers.'],
                    ['title' => 'Register your child', 'description' => 'Complete the admission form and submit the required documents.'],
                    ['title' => 'Start learning',    'description' => 'Settle the fees and your child joins their new class.'],
                ]),
                'admissions_cta_text' => 'Book a school visit',
                'admissions_cta_url'  => '#contact',
                'curriculum_heading'  => 'Our curriculum',
                'curriculum_text'     => 'We blend Montessori and Jolly Phonics for early childhood development, so each child learns at their own pace in a personalised setting. Primary pupils follow a full curriculum alongside Islamic and Arabic studies.',
                'fees_heading'        => 'Tuition fees',
                'fees_text'           => 'We believe transparency is key. Ask the school office for our current fee structure and schedule a tour to see how we invest in your child\'s future.',
                'fees_cta_text'       => 'Ask about fees',
                'fees_cta_url'        => '#contact',

                'features_heading' => 'Why parents choose us',

                'show_anthem'    => true,
                'anthem_heading' => 'Our school anthem',
                'anthem_arabic'  => null,
                'anthem_meaning' => "My Lord,\nO my Lord, You who answer prayers,\nMake today a day of success\nAnd of multiplied blessings.\nAssist me in my studies\nAnd in fulfilling my responsibilities.\nIlluminate my mind and my heart\nWith useful knowledge.\nProtect me and my town\nFrom sad occurrences.\nFill the whole world with peace\nAnd let it touch every part of the world.",
                'pledge_heading' => 'Our school pledge',
                'pledge_items'   => json_encode([
                    ['arabic' => '', 'meaning' => 'I pledge to Islam, my religion.'],
                    ['arabic' => '', 'meaning' => 'To be loyal to NASFAT, my society.'],
                    ['arabic' => '', 'meaning' => 'To be sincere, righteous and honest.'],
                    ['arabic' => '', 'meaning' => 'To be a servant of Allah alone, my Lord.'],
                    ['arabic' => '', 'meaning' => 'To accept the prophethood of Muhammad wholeheartedly.'],
                    ['arabic' => '', 'meaning' => 'To believe in the Angels of Allah as His creation.'],
                    ['arabic' => '', 'meaning' => 'To accept the Qur\'an as my guiding constitution.'],
                    ['arabic' => '', 'meaning' => 'To work in belief of the resurrection after death.'],
                    ['arabic' => '', 'meaning' => 'To believe in the predestination of Allah.'],
                    ['arabic' => '', 'meaning' => 'So help me, Allah.'],
                ]),

                'contact_heading' => 'Come and see us',
                'contact_intro'   => 'Have a question or want to book a visit? Send us a message and the school office will get back to you.',
                'office_hours'    => 'Monday to Friday, 8:00 am to 4:00 pm',

                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if (DB::table('programs')->count() === 0) {
            DB::table('programs')->insert([
                ['title' => 'Early years',            'description' => 'Montessori-style learning and Jolly Phonics build language, number sense and independence from the very first day.', 'icon' => 'sparkle',   'sort_order' => 1, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
                ['title' => 'Islamic & Arabic studies', 'description' => 'Qur\'an, Islamic studies and Arabic taught with care, so faith and good character grow alongside knowledge.',           'icon' => 'crescent', 'sort_order' => 2, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
                ['title' => 'Science & technology',   'description' => 'Hands-on experiments and technology lessons that spark curiosity and creative problem solving.',                        'icon' => 'flask',    'sort_order' => 3, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
                ['title' => 'Arts & humanities',      'description' => 'Music, drawing, storytelling and drama give every child a way to express what they think and feel.',                    'icon' => 'palette',  'sort_order' => 4, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
                ['title' => 'Sports & athletics',     'description' => 'Games and sports build teamwork, discipline and healthy habits on our open school grounds.',                          'icon' => 'ball',     'sort_order' => 5, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
                ['title' => 'Literacy & numeracy',    'description' => 'Strong reading, writing and mathematics foundations that prepare pupils for secondary school.',                        'icon' => 'book',     'sort_order' => 6, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

        if (DB::table('features')->count() === 0) {
            DB::table('features')->insert([
                ['title' => 'Experienced teachers', 'description' => 'Qualified, caring staff who know every child by name.',                          'icon' => 'graduation', 'sort_order' => 1, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
                ['title' => 'Safe, spacious grounds', 'description' => 'Open grounds, shaded classrooms and a school bus service for pupils.',        'icon' => 'building',   'sort_order' => 2, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
                ['title' => 'Thoughtful curriculum', 'description' => 'Programmes designed to encourage curiosity, creativity and good character.', 'icon' => 'book',       'sort_order' => 3, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
                ['title' => 'A supportive community', 'description' => 'A welcoming environment where parents, teachers and pupils work together.', 'icon' => 'users',      'sort_order' => 4, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

        if (DB::table('gallery_items')->count() === 0) {
            $items = [
                ['Our classroom block and school bus', 'school-images/school-block-bus.jpg'],
                ['The school mosque',                  'school-images/mosque-dome.jpg'],
                ['The mosque and school grounds',      'school-images/mosque-front.jpg'],
            ];

            $disk = config('filament.default_filesystem_disk', 'public');

            foreach ($items as $i => [$title, $source]) {
                $path = $source; // fallback: serve straight from public/

                // Copy into storage so the photo can be replaced or removed
                // from the admin panel like any other upload.
                try {
                    $file = public_path($source);
                    if (is_file($file)) {
                        $dest = 'website/gallery/' . basename($source);
                        Storage::disk($disk)->put($dest, file_get_contents($file), 'public');
                        $path = $dest;
                    }
                } catch (\Throwable $e) {
                    // keep the public/ fallback
                }

                DB::table('gallery_items')->insert([
                    'title' => $title, 'image' => $path, 'sort_order' => $i + 1,
                    'is_active' => true, 'created_at' => $now, 'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        // Content is user-editable, so nothing is removed on rollback.
        // The tables themselves are dropped by the create-tables migration.
    }
};
