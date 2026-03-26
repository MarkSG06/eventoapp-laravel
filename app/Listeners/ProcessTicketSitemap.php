<?php

namespace App\Listeners;

use App\Events\TicketStored;
use App\Services\SitemapService;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessTicketSitemap implements ShouldQueue
{
  public $queue = 'default';

  public function __construct(protected SitemapService $sitemapService) {}

  public function handle(TicketStored $event)
  {
    foreach ($event->ticket->locale as $language => $fields) {
      $slugs = ['title' => \Str::slug($fields['title'])];
      $this->sitemapService->updateOrCreateSlug('tickets', $event->ticket->id, $language, 'ticket', $slugs);
    }
  }
}