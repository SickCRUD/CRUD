<?php

namespace SickCRUD\CRUD\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // user answer
        $whatShouldBePublished = $this->choice('What "tag" should be published?', $this->publishableChoiches);

        // are you sure?
        if ($this->confirm('Do you wish to continue?')) {
            if ($this->vendorPublish($whatShouldBePublished)) {
                if ($whatShouldBePublished == 'All') {
                    $this->info('All the "tags" for SickCRUD have been published!');
                } else {
                    $this->info('The "tag" '.$whatShouldBePublished.' for SickCRUD have been published!');
                }
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
    public function vendorPublish($tag = '')
    {
        $commandParams = [
            '--provider' => 'SickCRUD\CRUD\SickCrudServiceProvider',
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
