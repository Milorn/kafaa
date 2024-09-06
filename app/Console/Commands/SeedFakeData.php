<?php

namespace App\Console\Commands;

use App\Enums\UserType;
use App\Models\Company;
use App\Models\Equipment;
use App\Models\Expert;
use App\Models\Label;
use App\Models\Post;
use App\Models\Project;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedFakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-fake-data {--m|migrate}';

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
        if ($this->option('migrate')) {
            $this->info('Migrating...');
            Artisan::call('migrate:fresh --seed');
        }

        $this->info('Seeding...');
        Expert::factory(5)
            ->has(User::factory()->type(UserType::Expert))
            ->has(Label::factory(), 'certificate')
            ->has(Project::factory(2))
            ->create();

        Company::factory(5)
            ->has(User::factory()->type(UserType::Company))
            ->has(Expert::factory(2)->has(User::factory()->type(UserType::Expert)))
            ->create();

        Provider::factory(5)
            ->has(User::factory()->type(UserType::Provider))
            ->create();

        Post::factory(10)
            ->create();

        Equipment::factory(20)
            ->create();
    }
}
