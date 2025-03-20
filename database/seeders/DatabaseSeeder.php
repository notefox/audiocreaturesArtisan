<?php

namespace Database\Seeders;

use App\Models\ReferenceLink;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ReferenceLinkFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        ReferenceLink::factory()->create(['name' => 'YouTube']);
        ReferenceLink::factory()->create(['name' => 'Vimeo']);
        ReferenceLink::factory()->create(['name' => 'SoundCloud']);
        ReferenceLink::factory()->create(['name' => 'Social']);
        ReferenceLink::factory()->create(['name' => 'Bandcamp']);
        ReferenceLink::factory()->create(['name' => 'Spotify']);
    }
}
