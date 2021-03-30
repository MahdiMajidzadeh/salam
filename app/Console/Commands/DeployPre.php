<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeployPre extends Command
{
    protected $signature = 'deploy:pre';

    protected $description = 'make system ready for deploy';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->call('view:clear');
        $this->call('route:clear');
        $this->call('event:clear');
        $this->call('config:clear');
        $this->call('debugbar:clear');
        $this->call('cache:clear');
        $this->call('clear-compiled');

        shell_exec('npm run prod');
    }
}
