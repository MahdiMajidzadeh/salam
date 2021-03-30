<?php

namespace App\Console\Commands;

use App\Model\Day;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PortalMakeDays extends Command
{
    protected $signature = 'portal:make-day {date} {amount}';

    protected $description = 'make days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $max = Day::max('day');

        if (is_null($max)) {
            $max = Carbon::create(2020, 10, 30);
        }
        $dod = $max;

        while (! $dod->equalTo(new Carbon($this->argument('date')))) {
            $dod                = $max->addDay();
            $day                = new Day();
            $day->day           = $dod;
            $day->charge_amount = $this->argument('amount');
            $day->save();
        }
    }
}
