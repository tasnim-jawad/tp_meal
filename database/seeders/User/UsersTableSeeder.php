<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        User::create([
            'user_role_serial' => 1,
            'department_id' => 1,
            'batch_id' => 1,
            'name' => 'Super Admin',
            'email' => 'super_admin@gmail.com',
            'email_verified_at' => now(),
            'image' => 'john_doe.jpg',
            'gender' => 'male',
            'mobile' => '1234567890',
            'whatsapp' => '1234567890',
            'telegram' => 'john_doe',
            'address' => '123 Main St',
            'password' => Hash::make('12345678'),
            'slug' => Str::slug('John Doe'),
            'creator' => 1,
            'status' => 'active',
        ]);

        User::create([
            'user_role_serial' => 2,
            'department_id' => 2,
            'batch_id' => 2,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'image' => 'jane_smith.jpg',
            'gender' => 'female',
            'mobile' => '0987654321',
            'whatsapp' => '0987654321',
            'telegram' => 'jane_smith',
            'address' => '456 Elm St',
            'password' => Hash::make('12345678'),
            'slug' => Str::slug('Jane Smith'),
            'creator' => 1,
            'status' => 'active',
        ]);

        User::create([
            'user_role_serial' => 3,
            'department_id' => 1,
            'batch_id' => 3,
            'name' => 'Michael Johnson',
            'email' => 'michaelj@example.com',
            'email_verified_at' => now(),
            'image' => 'michael_johnson.jpg',
            'gender' => 'male',
            'mobile' => '1112223333',
            'whatsapp' => '1112223333',
            'telegram' => 'michael_johnson',
            'address' => '789 Oak St',
            'password' => Hash::make('12345678'),
            'slug' => Str::slug('Michael Johnson'),
            'creator' => 2,
            'status' => 'active',
        ]);

        User::create([
            'user_role_serial' => 4,
            'department_id' => 2,
            'batch_id' => 4,
            'name' => 'Emily Davis',
            'email' => 'emilyd@example.com',
            'email_verified_at' => now(),
            'image' => 'emily_davis.jpg',
            'gender' => 'female',
            'mobile' => '2223334444',
            'whatsapp' => '2223334444',
            'telegram' => 'emily_davis',
            'address' => '123 Pine St',
            'password' => Hash::make('12345678'),
            'slug' => Str::slug('Emily Davis'),
            'creator' => 2,
            'status' => 'active',
        ]);

        User::create([
            'user_role_serial' => 3,
            'department_id' => 3,
            'batch_id' => 5,
            'name' => 'David Brown',
            'email' => 'davidb@example.com',
            'email_verified_at' => now(),
            'image' => 'david_brown.jpg',
            'gender' => 'male',
            'mobile' => '3334445555',
            'whatsapp' => '3334445555',
            'telegram' => 'david_brown',
            'address' => '456 Cedar St',
            'password' => Hash::make('12345678'),
            'slug' => Str::slug('David Brown'),
            'creator' => 3,
            'status' => 'active',
        ]);

        User::create([
            'user_role_serial' => 3,
            'department_id' => 4,
            'batch_id' => 6,
            'name' => 'Laura Wilson',
            'email' => 'lauraw@example.com',
            'email_verified_at' => now(),
            'image' => 'laura_wilson.jpg',
            'gender' => 'female',
            'mobile' => '4445556666',
            'whatsapp' => '4445556666',
            'telegram' => 'laura_wilson',
            'address' => '789 Maple St',
            'password' => Hash::make('12345678'),
            'slug' => Str::slug('Laura Wilson'),
            'creator' => 3,
            'status' => 'active',
        ]);

        User::create([
            'user_role_serial' => 3,
            'department_id' => 4,
            'batch_id' => 7,
            'name' => 'James Miller',
            'email' => 'jamesm@example.com',
            'email_verified_at' => now(),
            'image' => 'james_miller.jpg',
            'gender' => 'male',
            'mobile' => '5556667777',
            'whatsapp' => '5556667777',
            'telegram' => 'james_miller',
            'address' => '123 Birch St',
            'password' => Hash::make('12345678'),
            'slug' => Str::slug('James Miller'),
            'creator' => 4,
            'status' => 'active',
        ]);

        User::create([
            'user_role_serial' => 4,
            'department_id' => 5,
            'batch_id' => 8,
            'name' => 'Sara Taylor',
            'email' => 'sarat@example.com',
            'email_verified_at' => now(),
            'image' => 'sara_taylor.jpg',
            'gender' => 'female',
            'mobile' => '6667778888',
            'whatsapp' => '6667778888',
            'telegram' => 'sara_taylor',
            'address' => '456 Spruce St',
            'password' => Hash::make('12345678'),
            'slug' => Str::slug('Sara Taylor'),
            'creator' => 4,
            'status' => 'active',
        ]);

        User::create([
            'user_role_serial' => 3,
            'department_id' => 6,
            'batch_id' => 9,
            'name' => 'Daniel Martinez',
            'email' => 'danielm@example.com',
            'email_verified_at' => now(),
            'image' => 'daniel_martinez.jpg',
            'gender' => 'male',
            'mobile' => '7778889999',
            'whatsapp' => '7778889999',
            'telegram' => 'daniel_martinez',
            'address' => '789 Redwood St',
            'password' => Hash::make('12345678'),
            'slug' => Str::slug('Daniel Martinez'),
            'creator' => 5,
            'status' => 'active',
        ]);

        User::create([
            'user_role_serial' => 3,
            'department_id' => 6,
            'batch_id' => 10,
            'name' => 'Megan Clark',
            'email' => 'meganc@example.com',
            'email_verified_at' => now(),
            'image' => 'megan_clark.jpg',
            'gender' => 'female',
            'mobile' => '8889990000',
            'whatsapp' => '8889990000',
            'telegram' => 'megan_clark',
            'address' => '123 Walnut St',
            'password' => Hash::make('12345678'),
            'slug' => Str::slug('Megan Clark'),
            'creator' => 5,
            'status' => 'active',
        ]);
    }
}
