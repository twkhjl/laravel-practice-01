<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\zh_TW\Address($this->faker));
        // $this->faker->addProvider(new \Faker\Provider\zh_TW\Color($this->faker));
        $this->faker->addProvider(new \Faker\Provider\zh_TW\Company($this->faker));
        // $this->faker->addProvider(new \Faker\Provider\zh_TW\DateTime($this->faker));
        // $this->faker->addProvider(new \Faker\Provider\zh_TW\Person($this->faker));
        // $this->faker->addProvider(new \Faker\Provider\zh_TW\PhoneNumber($this->faker));
        // $this->faker->addProvider(new \Faker\Provider\zh_TW\Text($this->faker));

        $tag = $this->faker->randomElement(['java','php','python','javascript','react','angular','vue','jquery']);
        $title = $this->faker->randomElement(["junior $tag developer","senior $tag developer","$tag developer assistant"]);
        return [
            'title'=>$title,
            'tags'=>$tag,
            'company'=>$this->faker->company(),
            'location'=>$this->faker->city(),
            'email'=>$this->faker->unique()->companyEmail(),
            'website'=>$this->faker->url(),
            'description'=>$this->faker->paragraph(6),
        ];
    }
}
