<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeployPost extends Command
{
    protected $signature = 'deploy:post';

    protected $description = 'deploy post action';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        shell_exec('composer install --optimize-autoloader --no-dev');

        $this->call('clear-compiled');
        $this->call('view:cache');
        $this->call('config:cache');
//        $this->call('debugbar:clear');
        $this->call('cache:clear');
        $this->call('route:cache');
    }
}
