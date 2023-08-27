<?php

namespace App\Services;


abstract class ImageFaker
{

    public static function create($dir, $width, $height, $font, $text = "For Test", $x = 230, $y = 300)
    {
        $name = md5(uniqid(empty($_SERVER['SERVER_ADDR']) ? '' : $_SERVER['SERVER_ADDR'], true)); // إنشاء إسم فريد للصورة
        $filename = $name . '.png'; // إضافة اللاحقة للإسم
        $filepath = $dir . DIRECTORY_SEPARATOR . $filename; // إنشاء مسار الصورة بشكل كامل
      
        $image = imagecreate($width, $height); // إنشاء صورة
      
        imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)); // تلوين الصورة بلون عشوائي
      
        $textcolor = imagecolorallocate($image, 255, 255, 255); // إنشاء لون الكتابة على الصورة
      
        imagettftext($image, 28, 0, $x, $y, $textcolor, $font, $text); // الكتابة على الصورة
      
        imagepng($image, $filepath); // حفظ الصورة في المسار الذي أنشأناه في الأعلى
      
        imagedestroy($image); // تحرير أي حجم للذاكرة مرتبط بالصورة
      
        return $filename; // إرجاع إسم الصورة
    }
}