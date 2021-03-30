<?php

namespace App\Console\Commands;

use App\Model\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class PortalResetPassword extends Command
{
    protected $signature = 'portal:password-reset {mobile}';

    protected $description = 'reset password for user';

    public function __construct()
    {
        parent::__construct();
    }

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
