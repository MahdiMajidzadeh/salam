<?php

namespace App\Console\Commands;

use App\Model\User;
use App\Model\Permission;
use Illuminate\Console\Command;

class AdminFix extends Command
{
    protected $signature = 'admin:fix';

    protected $description = 'fix admin permissions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $user = User::find(1);

        $user->permissions()
            ->sync(
                Permission::all()
                    ->pluck('id')
                    ->toArray()
            );
    }
}
