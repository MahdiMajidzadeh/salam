<?php

namespace App\Console\Commands;

use App\Model\TahdigBooking;
use App\Model\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ZoomMessage extends Command
{
    protected $signature = 'zoom:message';
    protected $description = 'Send message to zoom';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::whereNotNull('zoom_url')->whereNotNull('zoom_auth')->get();
        foreach ($users as $user) {
            $reservation = $this->getToday($user->id);

            if (! is_null($reservation)) {
                $this->sendRequest(
                    $user->zoom_url,
                    $user->zoom_auth,
                    $reservation->food->name,
                    $reservation->food->restaurant->name
                );
            }
        }
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
        $client = new Client();
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
