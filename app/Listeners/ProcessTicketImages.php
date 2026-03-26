<?php

namespace App\Listeners;

use App\Events\TicketStored;
use App\Services\ImageService;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessTicketImages implements ShouldQueue
{
  public $queue = 'default';

  public function __construct(protected ImageService $imageService) {}

  public function handle(TicketStored $event)
  {
    if (!empty($event->images)) {
      $this->imageService->groupAdminImages($event->images, $event->ticket);
      $this->imageService->resizeImages($event->images, 'tickets', $event->ticket->id, $event->ticket);
    }
  }
}