<?php

namespace App\Console\Commands;

use App\Services\Api\ContextStrategy;
use App\Services\Api\Strategies\File;
use App\Services\Api\Strategies\Kinopoisk;
use Illuminate\Console\Command;
use Exception;


/**
 * Class MoviesUpdateCommand
 * @package App\Console\Commands
 */
class MoviesUpdateCommand extends Command
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
    protected $description = 'Getting data via the api and saving to the database';

    /**
     * @return void
     */
    public function handle()
    {
        try {
            (new ContextStrategy(app(File::class)))->execute();
            $this->info('The command was successful!');
        } catch (Exception $error) {
            exit($error->getMessage());
        }
    }
}
