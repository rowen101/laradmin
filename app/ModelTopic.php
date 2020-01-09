<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelTopic extends Model
{
    protected $table = "model_topics";
    protected $fillable = ['Topic','description'];
}
