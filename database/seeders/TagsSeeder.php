<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()->create([
            'name' => 'HTML'
        ]);
        Tag::factory()->create([
            'name' => 'API'
        ]);
        Tag::factory()->create([
            'name' => 'Laravel'
        ]);
        Tag::factory()->create([
            'name' => 'Backend'
        ]);
        Tag::factory()->create([
            'name' => 'Javascript'
        ]);
    }
}
