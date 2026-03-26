<?php

namespace App\Models\MongoDB;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

    protected $table = 'faqs';
    protected $connection = 'mongodb';
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return '_id';
    }

    protected $casts = [
        
    ];

    public function getQuestionAttribute()
    {
        return $this->locale[app()->getLocale()]['question'] ?? '';
    }

    public function getAnswerAttribute()
    {
        return $this->locale[app()->getLocale()]['answer'] ?? '';
    }
}
