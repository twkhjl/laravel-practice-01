<?php

namespace Database\Factories;

use App\Models\User;
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

        $tagNum =$this->faker->randomElement([1,2,3]);
        $tags = $this->faker->randomElements(['golang','java','php','python','javascript','react','angular','vue','jquery'],2);
        $tagsTxt = implode(',',$tags);
        $tag = collect($tags)->random();
        $title = $this->faker->randomElement(["junior $tag developer","senior $tag developer","$tag developer assistant"]);

        $user_ids = User::pluck('id');
        $user_id = $this->faker->randomElement($user_ids);

        return [
            'user_id'=>$user_id,
            'title'=>$title,
            'tags'=>$tagsTxt,
            'company'=>$this->faker->company(),
            'location'=>$this->faker->city(),
            'email'=>$this->faker->unique()->companyEmail(),
            'website'=>$this->faker->url(),
            'description'=>$this->faker->paragraph(6),
        ];
    }
}
