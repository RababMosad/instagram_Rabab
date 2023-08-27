<?php

namespace Database\Factories;

use App\Models\Post;
use App\Services\ImageFaker;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image_path' => 'uploads/' . ImageFaker::create(
                storage_path('app/public/uploads'),
                600,
                600,
                public_path('Roboto-Regular.ttf')
            ),
        ];
    }
}