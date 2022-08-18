<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $vehicles = \App\Models\Vehicle::pluck('id')->toArray();

        $startTime = fake()->dateTimeBetween('-1 week', '+1 week');
      
        return [
            'vehicle_id' => fake()->randomElement($vehicles),
            'contact_id' => function () {
              $contacts = \App\Models\Contact::pluck('id')->toArray();
              if(rand(0, 10) > 7){
                return fake()->randomElement($contacts);
              }else{
                return \App\Models\Contact::factory()->create()->id;
              }
            },
            'start_timestamp' => $startTime,
            'end_timestamp' => fake()->dateTimeBetween($startTime, '+1 month')
        ];
    }
}
