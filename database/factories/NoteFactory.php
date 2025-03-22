<?php

namespace Database\Factories;

use App\Models\Folder;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . uniqid(),
            'description' => $this->faker->paragraphs(3, true),
            'reminder_date' => $this->faker->date(),
            'priority' => $this->faker->randomElement(['default', 'very low', 'low', 'medium', 'high', 'very high']),
            'permission' => 'public',
            'pin' => $this->faker->boolean(),
            'favourite' => $this->faker->boolean(),
            'folder_id' => Folder::inRandomOrder()->first()->id ?? Folder::factory(),
        ];
    }
}
