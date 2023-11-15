<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(5)->create();

        $users->each(function ($user) {

            $companies = $user->companies()->saveMany(
                Company::factory(rand(2, 5))->create([
                    'user_id' => $user
                ])
            );

            $companies->each(function ($company) use ($user) {
                $company->contacts()->saveMany(
                    Contact::factory(rand(5, 10))
                    ->create([
                        'user_id' => $user,
                        'company_id' => $company
                    ])
                );
            });
        });

    }
}
