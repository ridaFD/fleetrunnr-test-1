<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sid' => $this->faker->name,
            'name' => $this->faker->name,
            'type' => 'admin',
            'country' => 'lb',
            'workspace' => 'home',
            'transactional_email' => 'rida@gmail.com',
            'transactional_phone' => '78975888',
            'timezone' => '+2',
            'is_active' => 1,
            'verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
