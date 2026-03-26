<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketStored
{
  use Dispatchable, SerializesModels;

  public function __construct(
    public $ticket,
    public $images,
  ) {}
}