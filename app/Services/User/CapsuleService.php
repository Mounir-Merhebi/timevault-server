<?php

namespace App\Services\User;

use App\Models\Capsule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;

class CapsuleService
{
    static function createCapsule($data)
    {
        $dataRules = [
            'title'=> 'string|max:255',
            'message'=> 'string',
            'privacy_setting' => 'in:private,public,unlisted',
            'reveal_date' => 'sometimes|nullable|date',
            'is_revealed'=> 'boolean',
            'cover_image_url' => 'string', 
            'media_image_url'=> 'string', 
            'audio_file_url' => 'string', 
            'custom_color' => 'string',
            'mood' => 'string',
            'text_note' => 'sometimes|nullable|file|mimes:md,txt', 
            'surprise_mode'=> 'boolean',
            'custom_emoji'=> 'string',
            'unlisted_link_token'=>'string',
            'gps_latitude' => 'nullable|numeric',
            'gps_longitude' => 'nullable|numeric',
            'location' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($data, $dataRules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validatedData = $validator->validated();
        $validatedData['user_id'] = auth()->id();

 
        $ip = request()->ip();
        $location = Location::get($ip);

        $validatedData['ip_address'] = $ip;
        $validatedData['location'] = $validatedData['location'] ?? ($location ? $location->countryName : 'Unknown');
        $validatedData['gps_latitude'] = $validatedData['gps_latitude'] ?? ($location ? $location->latitude : null);
        $validatedData['gps_longitude'] = $validatedData['gps_longitude'] ?? ($location ? $location->longitude : null);


        $validatedData['is_revealed'] = (bool) ($validatedData['is_revealed'] ?? false);
        $validatedData['surprise_mode'] = (bool) ($validatedData['surprise_mode'] ?? false);


 
        if (isset($validatedData['cover_image_url']) && str_starts_with($validatedData['cover_image_url'], 'data:image/')) {
            $validatedData['cover_image_url'] = self::saveBase64Image($validatedData['cover_image_url']);
        } else {
        
             $validatedData['cover_image_url'] = $validatedData['cover_image_url'] ?? null;
        }

        if (isset($validatedData['media_image_url']) && str_starts_with($validatedData['media_image_url'], 'data:image/')) {
            $validatedData['media_image_url'] = self::saveBase64Image($validatedData['media_image_url']);
        } else {
            $validatedData['media_image_url'] = $validatedData['media_image_url'] ?? null;
        }

        if (isset($validatedData['audio_file_url']) && str_starts_with($validatedData['audio_file_url'], 'data:audio/')) {
            $validatedData['audio_file_url'] = self::saveBase64Audio($validatedData['audio_file_url']);
        } else {
            $validatedData['audio_file_url'] = $validatedData['audio_file_url'] ?? null;
        }

     
        if (request()->hasFile('text_note')) {
            $textNoteFile = request()->file('text_note');
            $directory = storage_path('app/private/notes');
        
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
        
            $fileName = uniqid() . '.' . $textNoteFile->getClientOriginalExtension();
            $filePath = $directory . '/' . $fileName;
        
            file_put_contents($filePath, file_get_contents($textNoteFile));
            $validatedData['text_note'] = 'private/notes/' . $fileName;
        } else {
            $validatedData['text_note'] = $validatedData['text_note'] ?? null;
        }
        
     


        $capsule = new Capsule();

   
        $capsule->fill($validatedData);

    
        if (($validatedData['privacy_setting'] ?? null) === 'unlisted') {
            $capsule->unlisted_link_token = Str::uuid();
        } else {
            $capsule->unlisted_link_token = null;
        }

        $capsule->save();

        return $capsule;
    }

    public static function saveBase64Image($base64Image) {
        preg_match("/^data:image\/(.*);base64,/", $base64Image, $matches);
        $imageType = $matches[1] ?? 'png';
        $imageData = Str::after($base64Image, ',');
        $imageData = base64_decode($imageData);

        $directory = storage_path('app/private/images');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = uniqid() . '.' . $imageType;
        $filePath = $directory . '/' . $fileName;
        file_put_contents($filePath, $imageData);

        return 'private/images/' . $fileName;
    }


    public static function saveBase64Audio($base64Audio) {
        preg_match("/^data:audio\/(.*);base64,/", $base64Audio, $matches);
        $mimeSubtype = $matches[1] ?? 'mpeg';

        $extension = 'mp3';
        switch ($mimeSubtype) {
            case 'mpeg':
                $extension = 'mp3';
                break;
            case 'wav':
                $extension = 'wav';
                break;
            case 'ogg':
                $extension = 'ogg';
                break;
            case 'aac':
                $extension = 'aac';
                break;
            default:
                if (Str::contains($mimeSubtype, 'mp4')) $extension = 'm4a';
                break;
        }

        $audioData = Str::after($base64Audio, ',');
        $audioData = base64_decode($audioData);

        $directory = storage_path('app/private/audios');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = uniqid() . '.' . $extension;
        $filePath = $directory . '/' . $fileName;
        file_put_contents($filePath, $audioData);

        return 'private/audios/' . $fileName;
    }
}