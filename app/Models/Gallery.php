<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with =['user'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comment(){
        return $this->hasMany(Comment_log::class);
    }
    public function likes(){
        return $this->belongsToMany(User::class,'gallery_like');
    }
    public function image(){
        return asset('storage/'. $this->path);
    }
}
