<?php

namespace Database\Factories;

use App\Models\Post;

use Intervention\Image\Facades\Image as ImageFacade;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;
use Faker\Factory as Faker;
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
        // return [
        //     'image_path' => 'uploads/' . ImageFaker::create(
        //         storage_path('app/public/uploads'),
        //         600,
        //         600,
        //         public_path('Roboto-Regular.ttf')
        //     ),
        // ];


    // $imagePath = storage_path('app/public/uploads'); // مسار حفظ الصور
    // if (!file_exists($imagePath)) {
    //     mkdir($imagePath, 0755, true); // إنشاء المجلد إذا لم يكن موجودًا
    // }

    // // استخدام مكتبة Picsum لإنشاء الصور
    // return [
    //     'image_path' => \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider::image(
    //         $imagePath,  // المسار المحلي لحفظ الصورة
    //         600,         // العرض
    //         400,         // الطول
    //         true         // تحديد إذا ما كان المسار كاملًا
    //     ),
    // ];

    return[
        'image_path' => 'uploads/' . basename(
                $this->faker->image(
                    storage_path('app/public/uploads'), // مسار تخزين الصورة
                    600, // العرض
                    600, // الطول
                    true // التأكد من تحديد isFullPath كـ true
                )
            ),
    ];
  }
}
