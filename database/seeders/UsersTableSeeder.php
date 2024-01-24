<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'locale'         => '',
                'address'        => '',
                'phone'          => '',
                'user_type'      => 'admin', // Ovdje trebate postaviti odgovarajuću vrijednost
                'company_id'     => null, // Ovo će se popuniti u foreach petlji ako je potrebno
            ],
            // Možete dodati još korisnika ovdje
        ];
        
        foreach ($users as $user) {
            // Postavljanje company_id ako je korisnik firma
            if ($user['user_type'] == 'company') {
                $user['company_id'] = '00100'; // Ovdje možete postaviti logiku za generisanje jedinstvenog ID-a
            }

            // Ako korisnik već postoji, ne dodajemo ga ponovo
            if (!User::where('email', $user['email'])->exists()) {
                User::create($user);
            }
        }
    }
}
