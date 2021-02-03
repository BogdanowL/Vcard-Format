<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use Illuminate\Console\Command;

class AssignRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:role {role} {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns role to user';

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
        try {

            $slug = $this->argument('role');
            $role = Role::where('slug', $slug)->first();
            if (!$role) {
                $this->error("Invalid role $role");

        }

            $user_id = $this->argument('user_id');
            $user = User::where('id', $user_id)->first();
            if (!$user) {
                $this->error("Invalid User ID $user_id");
            }
            $user->roles()->attach($role);
            $this->info("User UD: $user_id now has role $slug");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }

    }
}
