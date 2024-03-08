<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function avatar(){
        if ($this->profile->photo) {
            return asset('storage/'. $this->profile->photo);
        }
        return "https://api.dicebear.com/7.x/notionists/svg?seed={{$this->username}}&backgroundColor=b6e3f4,c0aede,d1d4f9";
    }
    public function profile() {
    return $this->hasOne(Profile::class);
    }
    public function galleries() {
    return $this->hasMany(Gallery::class);
    }
    public function comment_log(){
        return $this->hasMany(Comment_log::class);
    }
    public function likes() {
    return $this->belongsToMany(Gallery::class,'gallery_like')->withTimestamps();
    }
    public function likesUser(Gallery $image)
    {
        return $this->likes()->where('gallery_id',$image->id)->exists();
    }
    public function getRouteKeyName() {
        return 'slug';
    }

}
