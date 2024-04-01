<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class RunApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    //composer install
        $this->info('Installing composer dependencies...');
        shell_exec('composer install');
    


    //env
        $this->info('Setting up the environment...');
        //copy the .env.example file to .env and create .env file if not exists
        if (!file_exists('.env')) {
            copy('.env.example', '.env');
        }
     
    // Database
        $this->info('Creating the database...');
        $databaseName = env('DB_DATABASE', '');
        if (!empty($databaseName)) {
            $exists = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$databaseName]);

            if (empty($exists)) {
                DB::statement("CREATE DATABASE $databaseName");
                $this->info("Database `$databaseName` created.");
            } else {
                $this->info("Database `$databaseName` already exists. Skipping creation.");
            }
        } else {
            $this->error('DB_DATABASE is not set in .env file.');
        }
    
    //command to get host, root and password from user and set it in .env file
        $this->info('Setting up the database credentials...');
        $host = $this->ask('Enter the host for the database');
        $root = $this->ask('Enter the root user for the database');
        $password = $this->secret('Enter the password for the root user');
        $this->info('Setting up the database credentials...');
        
        $env = file_get_contents('.env');
        $env = preg_replace('/DB_HOST=.*/', "DB_HOST=$host", $env);
        $env = preg_replace('/DB_USERNAME=.*/', "DB_USERNAME=$root", $env);
        $env = preg_replace('/DB_PASSWORD=.*/', "DB_PASSWORD=$password", $env);
        file_put_contents('.env', $env);

    //migrations
        $this->info('Running the migrations...');
        Artisan::call('migrate');

    // Seeds
        $this->info('Running database seeds...');

        $seedsRun = DB::table('seeds')->where('name', 'DatabaseSeeder')->first();

        if (!$seedsRun) {
            Artisan::call('db:seed');
            DB::table('seeds')->insert(['name' => 'DatabaseSeeder']);
            $this->info('Database seeds run.');
        } else {
            $this->info('Database seeds already run. Skipping seeding.');
        }

    // Serve the application using PHP's built-in server
        $this->info('Serving application on http://localhost:8000');
        Artisan::call('serve');
     

    }
}
