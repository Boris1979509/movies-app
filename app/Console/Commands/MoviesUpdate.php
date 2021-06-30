<?php

namespace App\Console\Commands;

use App\Services\Api\ContextStrategy;
use App\Services\Api\Strategies\Kinopoisk;
use Illuminate\Console\Command;
use Exception;


/**
 * Class MoviesUpdate
 * @package App\Console\Commands
 */
class MoviesUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @return void
     */
    public function handle()
    {
        try {
            (new ContextStrategy(app(Kinopoisk::class)))->execute();
            $this->info('The command was successful!');
        } catch (Exception $error) {
            exit($error->getMessage());
        }
    }
}
