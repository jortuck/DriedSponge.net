<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FileUpload extends Model
{
    //Table Name
    protected $table = 'file_uploads';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    // is the file a video
    public function isVideo()
    {
        return Str::contains($this->type, ["mp4", "webm"]);
    }

    // Get file path
    public function path()
    {
        return $this->isVideo() && !$this->private ? "public/videos/" . $this->name : "/uploads/" . $this->type . "/" . $this->name;
    }

    // Get file url
    public function url()
    {
        return $this->isVideo() ? asset("/videos/" . $this->name) : route('upload.load-file', $this->name) . "." . $this->type;
    }

}
