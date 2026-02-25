<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'fiscal_name',
        'nif',
        'tax_amount',
        'total_before_tax',
        'total_tax',
        'total_after_tax',
        'datetime',
        'ticket_number',
    ];

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
