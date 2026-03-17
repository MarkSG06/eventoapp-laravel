<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MySQL\Sitemap;

class SitemapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $urls = [
        [
          "language" => "es",
          "path" => config('app.url') . "/es",
          "route_name" => "es.home"
        ],
        [
          "language" => "en",
          "path" => config('app.url') . "/en",
          "route_name" => "en.home"
        ],
	      [
          "language" => "es",
          "path" => config('app.url') . "/es/tickets",
          "route_name" => "es.tickets"
        ],
        [
          "language" => "en",
          "path" => config('app.url') . "/en/tickets",
          "route_name" => "en.tickets"
        ]
      ];

      foreach ($urls as $url) {
        Sitemap::create($url);
      }
    }
}