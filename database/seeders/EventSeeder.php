<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'title' => 'Recite with Nauhakhwan Sonu Monu',
            'tag' => 'Nauha',
            'event_date' => '2025-02-19',
            'start_time' => '10:00:00',
        ]);
        
        Event::create([
            'title' => 'Recite with Maulana Kumail Mehdavi',
            'tag' => 'Majlis',
            'event_date' => '2025-02-19',
            'start_time' => '10:15:00',
        ]);
        
    }
}
