<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MySqlDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the mysqldump utility using info from .env';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');

        $filePath = storage_path('dump').DIRECTORY_SEPARATOR.$database.'.sql';
        $command = sprintf('mysqldump -h%s -u%s -p%s %s --no-data > %s', $host, $username, $password, $database, $filePath);
        exec($command);
    }
}
