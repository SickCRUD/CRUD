<?php

namespace SickCRUD\CRUD\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use SickCRUD\CRUD\SickCrudServiceProvider;
use Anhskohbo\NoCaptcha\NoCaptchaServiceProvider;

class CrudInstallCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'SickCRUD:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to install SickCRUD and dependencies.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $providersToPublish = [
            SickCrudServiceProvider::class => 'all',
            NoCaptchaServiceProvider::class => 'all',
        ];

        // publish CRUD files
        $this->massPublish($providersToPublish);
    }

    /**
     * Publishing function through Artisan.
     *
     * @param string $provider
     * @param string $tag
     *
     * @return bool
     */
    public function vendorPublish($provider = SickCrudServiceProvider::class, $tag = 'all')
    {
        $commandParams = [
            '--provider' => $provider,
        ];

        if (strtolower($tag) == 'all') {
            $commandParams['--all'] = '';
        } else {
            $commandParams['--tag'] = $tag;
        }

        // if the exit code is 0 return true
        return Artisan::call('vendor:publish', $commandParams) == 0;
    }

    /**
     * Mass publish many provider.
     *
     * @param array $publishArray
     */
    public function massPublish(array $providersArray = [])
    {

        // build the progress bar
        $progress = $this->output->createProgressBar(count($providersArray));

        // add carriage return to loading
        $progress->setFormat(" %current%/%max% [%bar%] %percent:3s%% \r");

        // cycle through the providers
        foreach ($providersArray as $publishProvider => $tag) {

            // publishing verbose
            $this->output->write('Publishing '.$publishProvider.' files.');

            // update the progressbar
            $progress->advance();

            // publish the provider
            $this->vendorPublish($publishProvider, $tag);
        }

        // progress end
        $progress->finish();

        // newLine
        $this->output->write("\n");

        // notify operation end
        $this->output->writeLn('All the files were published.');
    }
}
