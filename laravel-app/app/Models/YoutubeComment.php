<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeComment extends Model
{
    protected $fillable = [
        'youtube_analysis_id',
        'comment',
        'category',
        'confidence'
    ];

    public function analysis()
    {
        return $this->belongsTo(YoutubeAnalysis::class);
    }
}