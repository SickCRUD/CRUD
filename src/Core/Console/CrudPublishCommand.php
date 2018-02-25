<?php

namespace SickCRUD\CRUD\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use SickCRUD\CRUD\SickCrudServiceProvider;

class CrudPublishCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'SickCRUD:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to publish the assets of SickCRUD.';

    /**
     * Publishable choiches.
     *
     * @var array
     */
    protected $publishableChoiches = [
        'All',
        'config',
        'views',
        'public',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // user answer
        $whatShouldBePublished = $this->choice('What would you like to publish?', $this->publishableChoiches);

        // are you sure?
        if ($this->confirm('Do you wish to continue?')) {
            if ($this->vendorPublish($whatShouldBePublished)) {
                $this->info(ucfirst($whatShouldBePublished).' for SickCRUD has been published!');
            } else {
                $this->error('There was an error while publishing the assets!');
            }
        }
    }

    /**
     * Publishing function through Artisan.
     *
     * @param string $tag
     *
     * @return bool
     */
    public function vendorPublish($tag = 'All')
    {
        $commandParams = [
            '--provider' => SickCrudServiceProvider::class,
        ];

        if ($tag == 'All') {
            $commandParams['--all'] = '';
        } else {
            $commandParams['--tag'] = $tag;
        }

        // if the exit code is 0 return true
        return Artisan::call('vendor:publish', $commandParams) == 0;
    }
}
