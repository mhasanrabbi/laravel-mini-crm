<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $users = collect(User::all()->modelKeys());
        $clients = collect(Client::all()->modelKeys());

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'user_id' => $users->random(),
            'client_id' => $clients->random(),
            'deadline' => $this->faker->dateTimeBetween('+1 month', '+6 month'),
            'status' => Arr::random(Project::STATUS),
        ];
    }
}