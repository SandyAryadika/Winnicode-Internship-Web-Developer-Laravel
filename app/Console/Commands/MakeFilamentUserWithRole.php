<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class MakeFilamentUserWithRole extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:filament-user-role 
                            {name : Name of the user}
                            {email : Email address}
                            {password : Password}
                            {role : Role name (admin or writer)}';

    /**
     * The console command description.
     */
    protected $description = 'Create a Filament user with a specified role (admin/writer)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');
        $role = strtolower($this->argument('role'));

        if (!in_array($role, ['admin', 'writer'])) {
            $this->error("Role harus 'admin' atau 'writer'.");
            return 1;
        }

        // Create the role if it doesn't exist
        Role::firstOrCreate(['name' => $role]);

        // Cek apakah user sudah ada
        if (User::where('email', $email)->exists()) {
            $this->error('User dengan email ini sudah ada.');
            return 1;
        }

        // Create user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole($role);

        $this->info("User '$name' dengan role '$role' berhasil dibuat.");
        return 0;
    }
}
