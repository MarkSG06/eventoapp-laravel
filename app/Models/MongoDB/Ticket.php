<?php

namespace App\Models\MongoDB;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

    protected $table = 'tickets';
    protected $connection = 'mongodb';
    protected $primaryKey = '_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return '_id';
    }

    protected $casts = [
        'tax_amount' => 'decimal:2',
        'total_before_tax' => 'decimal:2',
        'total_tax' => 'decimal:2',
        'total_after_tax' => 'decimal:2',
        'datetime' => 'datetime',
    ];

    public function details()
    {
        return $this->hasMany(TicketDetail::class);
    }

    public function collections()
    {
        return $this->hasMany(TicketCollection::class);
    }
}
