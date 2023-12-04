<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\File; // Add the appropriate namespace for the File model
use App\Models\Group; // Add the appropriate namespace for the Group model

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(), 
            'status' => $this->faker->randomNumber(),
            'path' => $this->faker->filePath(),
            'group_id' => Group::factory(),
        ];
    }
}
