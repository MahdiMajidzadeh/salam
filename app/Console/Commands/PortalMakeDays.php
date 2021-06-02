<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Day;
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
        $max = new carbon(Day::max('day'));

        if (is_null($max)) {
            $max = Carbon::create(2020, 10, 30);
        }

        while (! $max->equalTo(new Carbon($this->argument('date')))) {
            $dod                = $max->addDay();
            $day                = new Day();
            $day->day           = $dod;
            $day->charge_amount = $this->argument('amount');
            $day->save();
        }
    }
}
