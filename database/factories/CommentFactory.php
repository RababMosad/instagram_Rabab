<?php

namespace Database\Factories;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{



    protected $model=Comment::class;
    /**
     
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
'user_id'=>$this->faker->numberBetween(1,10),
'post_id'=>$this->faker->numberBetween(1,60),
'comment'=>$this->faker->text(100),

        
        ];
    }
}
