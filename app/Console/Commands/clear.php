<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class clear extends Command
{
    protected $signature = 'clear';

    protected $description = 'Command description';

    public function handle()
    {
        $this->call('optimize');
        $this->info('Clearing optimize...');
        
        $this->info('Clearing cache...');
        $this->call('cache:clear');
        $this->info('Cache cleared successfully.');

        $this->info('Clearing config cache...');
        $this->call('config:clear');
        $this->info('Config cache cleared successfully.');

        $this->info('Clearing route cache...');
        $this->call('route:clear');
        $this->info('Route cache cleared successfully.');

        $this->info('Clearing view cache...');
        $this->call('view:clear');
        $this->info('View cache cleared successfully.');
    }
}
