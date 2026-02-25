<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCollection extends Model
{
    protected $table = 'ticket_collections';

    protected $fillable = [
        'ticket_id',
        'name',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
