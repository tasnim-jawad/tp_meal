<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Holiday::truncate();
        Holiday::create([
            'title' => 'Shaheed Day',
            'date' => '2024-02-21',
            'description' => 'Commemoration of the Language Movement martyrs',
            'slug' => 'shaheed-day',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Shab e-Barat',
            'date' => '2024-02-26',
            'description' => 'Night of forgiveness',
            'slug' => 'shab-e-barat',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Sheikh Mujibur Rahman\'s Birthday',
            'date' => '2024-03-17',
            'description' => 'Birthday of the Father of the Nation',
            'slug' => 'sheikh-mujibur-birthday',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Independence Day',
            'date' => '2024-03-26',
            'description' => 'Celebration of Independence Day of Bangladesh',
            'slug' => 'independence-day',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Jumatul Bidah',
            'date' => '2024-04-05',
            'description' => 'Last Friday of Ramadan',
            'slug' => 'jumatul-bidah',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Eid ul-Fitr Holiday',
            'date' => '2024-04-10',
            'description' => 'Eid ul-Fitr Holiday',
            'slug' => 'eid-ul-fitr-holiday',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Eid ul-Fitr',
            'date' => '2024-04-11',
            'description' => 'Celebration of Eid ul-Fitr',
            'slug' => 'eid-ul-fitr',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Eid ul-Fitr Holiday',
            'date' => '2024-04-12',
            'description' => 'Post Eid ul-Fitr Holiday',
            'slug' => 'eid-ul-fitr-holiday-2',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Bengali New Year',
            'date' => '2024-04-14',
            'description' => 'Pohela Boishakh - Bengali New Year celebration',
            'slug' => 'bengali-new-year',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'May Day',
            'date' => '2024-05-01',
            'description' => 'International Workers\' Day',
            'slug' => 'may-day',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Buddha Purnima',
            'date' => '2024-05-22',
            'description' => 'Buddhist festival marking Gautama Buddha\'s birth',
            'slug' => 'buddha-purnima',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Eid ul-Adha Holiday',
            'date' => '2024-06-16',
            'description' => 'Pre Eid ul-Adha Holiday',
            'slug' => 'eid-ul-adha-holiday',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Eid ul-Adha',
            'date' => '2024-06-17',
            'description' => 'Celebration of Eid ul-Adha',
            'slug' => 'eid-ul-adha',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Eid ul-Adha Holiday',
            'date' => '2024-06-18',
            'description' => 'Post Eid ul-Adha Holiday',
            'slug' => 'eid-ul-adha-holiday-2',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Ashura',
            'date' => '2024-07-17',
            'description' => 'Islamic holy day marking the martyrdom of Husayn ibn Ali',
            'slug' => 'ashura',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'National Mourning Day',
            'date' => '2024-08-15',
            'description' => 'Commemoration of the assassination of Sheikh Mujibur Rahman',
            'slug' => 'national-mourning-day',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Shuba Janmashtami',
            'date' => '2024-08-26',
            'description' => 'Celebration of the birth of Lord Krishna',
            'slug' => 'shuba-janmashtami',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Eid-e-Milad un-Nabi',
            'date' => '2024-09-16',
            'description' => 'Celebration of the birth of Prophet Muhammad',
            'slug' => 'eid-e-milad-un-nabi',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Vijaya Dashami',
            'date' => '2024-10-13',
            'description' => 'Hindu festival celebrating the victory of good over evil',
            'slug' => 'vijaya-dashami',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Victory Day',
            'date' => '2024-12-16',
            'description' => 'Commemoration of Victory Day of Bangladesh',
            'slug' => 'victory-day',
            'creator' => 1,
            'status' => 'active',
        ]);

        Holiday::create([
            'title' => 'Christmas Day',
            'date' => '2024-12-25',
            'description' => 'Christian holiday celebrating the birth of Jesus',
            'slug' => 'christmas-day',
            'creator' => 1,
            'status' => 'active',
        ]);
    }
}
