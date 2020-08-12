<?php

namespace App\Console\Commands;

use App\Model\Booking;
use App\Model\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ZoomMessage extends Command
{
    protected $signature = 'zoom:message';

    protected $description = 'Send message to zoom';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereNotNull('zoom_url')->whereNotNull('zoom_auth')->get();
        foreach ($users as $user) {
            $food = $this->getToday($user->id);
            if (! is_null($food)) {
                $this->sendRequest(
                    $user->zoom_url,
                    $user->zoom_auth,
                    $food->food->name,
                    $food->restaurant->name
                );
            }
        }
    }

    public function getToday($userId)
    {
        $booking = Booking::query()
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
                'Authorization' => $auth,
                'body'          => json_encode([
                    'food'       => $food,
                    'restaurant' => $restaurant,
                ]),
            ],
        ]);
    }
}
