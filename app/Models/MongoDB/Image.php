<?php

namespace App\Models\MongoDB;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
  use HasFactory, SoftDeletes;

  protected $connection = 'mongodb';
  protected $table = 'images';
  public $timestamps = true;

  protected $guarded = [];

  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];

  public function getRouteKeyName()
  {
    return '_id';
  }
}