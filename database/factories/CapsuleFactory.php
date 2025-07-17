<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Capsule>
 */
class CapsuleFactory extends Factory
{
    /**
     * The Faker instance for the factory.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    public function __construct($count = null, $states = null, $has = null, $for = null, $afterMaking = null, $afterCreating = null, $connection = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
        $this->faker = Faker::create('en_US');
    }

    public function definition(): array
    {
        return [
            "user_id" => 1,
            "title" => $this->faker->words(3, true),
            "message" => $this->faker->paragraph,
            "reveal_date" => $this->faker->dateTimeBetween('now', '+1 year'), 
            "privacy_setting" => $this->faker->randomElement(['public', 'private', 'unlisted']),
            "gps_latitude" => $this->faker->randomFloat(8, -90, 90),
            "gps_longitude" => $this->faker->randomFloat(8, -180, 180),
            "ip_address" => $this->faker->ipv4,
            "is_revealed" => false, 
            "custom_color" => $this->faker->hexColor, 
            "custom_emoji" => $this->faker->emoji, 
            "cover_image_url" => 'covers/' . $this->faker->uuid . '.jpg', 
            "media_image_url" => $this->faker->boolean ? 'images/' . $this->faker->uuid . '.jpg' : null, 
            "audio_file_url" => $this->faker->boolean ? 'audio/' . $this->faker->uuid . '.mp3' : null, 
            "text_note" => $this->faker->boolean ? $this->faker->text(500) : null, 
            "surprise_mode" => $this->faker->boolean, 
            "mood" => $this->faker->word,
            "unlisted_link_token" => $this->faker->boolean ? $this->faker->uuid : null, 
        ];
    }
}