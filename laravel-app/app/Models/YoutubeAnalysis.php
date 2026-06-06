<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeAnalysis extends Model
{
    protected $fillable = [

        'video_url',
        'thumbnail',
        'total_comments',
        'cyberbullying_count',
        'non_bullying_count',
        'cyberbullying_percentage',
        'analysis_time'

    ];

    public function comments()
    {
        return $this->hasMany(YoutubeComment::class);
    }
}