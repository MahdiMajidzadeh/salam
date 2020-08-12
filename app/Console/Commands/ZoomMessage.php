<?php

namespace App\Console\Commands;

use App\Model\Restaurant;
use App\Model\User;
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
        foreach ($users as $user){

        }
    }

    
}
