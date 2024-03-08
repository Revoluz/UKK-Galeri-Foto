<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_log extends Model
{
    use HasFactory;
    protected $table = 'comment_logs';
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function gallery() {
    return $this->belongsTo(Gallery::class);
    }
}
