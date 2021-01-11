<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
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
        $user = User::factory()->count(10)->create();

        /**
         * run the seeder x2 each time the seeder will create one account and give him 10 users in table account_user
         * second time will create another account and give him second 10 users from 11 to 20 ids;
         **/
        Account::factory()->count(1)->hasAttached(
            $user, ['permissions' => json_encode([1 => 'admin', 2 => "editor"])]
        )->create();
    }
}
