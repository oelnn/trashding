<?php

namespace App\Console\Commands;

use App\Services\RssTrendingService;
use Illuminate\Console\Command;

class FetchTrashding extends Command
{
    protected $signature = 'trashding:fetch';

    protected $description = 'Fetch trending topics';

    public function handle(RssTrendingService $service)
    {
        $service->fetch();
        $this->info('Trashding trending updated');
    }
}
