<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\DB;

class post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'post_caption',
        'image_path',
      
    ];

public function user(){
    return $this->belongsTo(User::class);
}
public function comments(){
    return $this->hasMany(Comment::class);

}
public function likedByUsers()
{
  return $this->belongsToMany(User::class , 'likes');
}

public function likedByUser(User $user){
    return (bool)DB::table('likes')
    ->where('user_id',$user->id)
    ->where('post_id',$this->id)
    ->count();
}


}
