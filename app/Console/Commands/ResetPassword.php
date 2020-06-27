<?php

namespace App\Console\Commands;

use App\Model\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:reset {mobile}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset password for user';

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
     * @return mixed
     */
    public function handle()
    {
        $user = User::query()
            ->where('mobile', $this->argument('mobile'))
            ->firstOrFail();
        $user->password = Hash::make($this->argument('mobile'));
        $user->save();

        $this->info('Done !!!');
    }
}
