<?php

namespace App\Console\Commands;

use App\Model\User;
use Illuminate\Console\Command;

class ChargeMonthly extends Command
{
    protected $signature = 'charge {amount}';

    protected $description = 'charge monthly';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::whereNull('deactivated_at')
            ->where('is_inter', false)
            ->increment('tahdig_credits', $this->argument('amount'));
    }
}
