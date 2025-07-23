<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Capsule extends Model
{
    use HasFactory;


    public function user(){     
         return $this->belongsTo(User::class, 'user_id');
        }
        
        protected $fillable = [
            'user_id',
            'title',
            'message',
            'privacy_setting',
            'gps_longitude',
            'gps_latitude',
            'ip_address',
            'location',
            'surprise_mode',
            'cover_image_url',
            'media_image_url',
            'audio_file_url',
            'is_revealed',
            'reveal_date',
            'mood',
            'custom_emoji',
            'text_note',
            'custom_color',
        ];

}
