<?php

namespace App\Console\Commands;

use Goutte\Client;
use App\Model\User;
use App\Model\TahdigBooking;
use Illuminate\Console\Command;

class ZoomMessage extends Command
{
    protected $signature   = 'zoom:message';
    protected $description = 'Send message to zoom';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $client  = new Client();
        $crawler = $client->request('GET', 'https://ketabchi.org/search?q=9786006958965');

        if ($crawler->filter('.result-wrapper.row div a')->count() == 0) {
            $this->warn('not found');

            return;
        }
        $link = $crawler->filter('.result-wrapper.row div a')->first()->link()->getUri();

        $crawler = $client->request('GET', $link);

        $this->info($crawler->filter('h1 span')->first()->text());
        $this->info($crawler->filter('.publisher h3 a')->first()->text());
        $crawler->filter('.person h3 a')->each(function ($node) {
            $this->info($node->text());
        });
        $this->info($crawler->filter('.thumb img')->first()->image()->getUri());
    }

    public function getToday($userId)
    {
        $booking = TahdigBooking::query()
            ->where('booking_date', now()->toDateString())
            ->first();

        if ($booking !== null) {
            return $booking->reservations()
                ->where('user_id', $userId)
                ->first();
        }

        return null;
    }

    public function sendRequest($url, $auth, $food, $restaurant)
    {
        $client   = new Client();
        $response = $client->post($url.'?format=fields', [
            'headers' => [
                'debug'         => true,
                'Authorization' => $auth,
            ],
            'json'    => [
                'food'       => $food,
                'restaurant' => $restaurant,
            ],
        ]);
    }
}
