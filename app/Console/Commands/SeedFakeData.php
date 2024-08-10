<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Expert;
use App\Models\Post;
use App\Models\Provider;
use Illuminate\Console\Command;

class SeedFakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-fake-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed fake data for testing purposes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Expert::factory(5)
            ->create();

        Company::factory(5)
            ->create();

        Provider::factory(5)
            ->create();

        Post::factory(10)
            ->create();
    }
}
