<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Available list of countries for seeding.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $countries;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->countries = $this->countries ?? Http::acceptJson()
            ->get('https://restcountries.com/v3.1/subregion/South America?fields=cca3')
            ->collect();

        $country = $this->countries->random()['cca3'];

        return [
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'identifier' => fake()->ssn(),
            'country' => $country,
            'mobile' => str(fake()->e164PhoneNumber())->reverse()->limit(10, '')->reverse(),
            'address' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'remember_token' => Str::random(10),
            'category_id' => Category::inRandomOrder()->first()['id'],
        ];
    }
}
