<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Campaign;
use Faker\Generator as Faker;

class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $categoryIds = [3, 6, 7, 9, 14, 15];
        // return [
        //     'user_id' => $this->faker->randomNumber(),
        //     'category_id' => $this->faker->randomElement($categoryIds),
        //     'title' => $this->faker->sentence(),
        //     'slug' => $this->faker->slug(),
        //     'short_description' => $this->faker->paragraph(),
        //     'description' => $this->faker->text(),
        //     'campaign_owner_commission' => $this->faker->randomFloat(2, 0, 100),
        //     'goal' => $this->faker->randomFloat(2, 1000, 10000),
        //     'min_amount' => $this->faker->randomFloat(2, 10, 500),
        //     'max_amount' => $this->faker->randomFloat(2, 500, 1000),
        //     'recommended_amount' => $this->faker->randomFloat(2, 10, 100),
        //     'total_funded' => $this->faker->randomFloat(2, 0, 5000),
        //     'total_payments' => $this->faker->randomNumber(),
        //     'amount_prefilled' => $this->faker->randomNumber(), // Modify according to your requirement
        //     'end_method' => $this->faker->randomElement(['method1', 'method2']), // Adjust as needed
        //     'views' => $this->faker->randomNumber(),
        //     'video' => $this->faker->imageUrl(),
        //     'feature_image' => $this->faker->imageUrl(),
        //     'status' => $this->faker->randomElement([0, 1, 2]),
        //     'country_id' => $this->faker->randomNumber(),
        //     'address' => $this->faker->address(),
        //     'is_funded' => $this->faker->randomElement([0, 1, 2]),
        //     'is_staff_picks' => $this->faker->randomElement([0, 1]),
        //     'start_date' => $this->faker->date(),
        //     'end_date' => $this->faker->date(),
        //     'total_funded_last_upated_at' => $this->faker->dateTime(),
        // ];
    }
}
