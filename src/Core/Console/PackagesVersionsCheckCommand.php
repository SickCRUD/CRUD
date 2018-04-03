<?php

namespace SickCRUD\CRUD\Core\Console;

use Composer\Semver\Comparator;
use Illuminate\Console\Command;

class PackagesVersionsCheckCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'SickCRUD:update-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check the SickCRUD dependencies versions.';

    /**
     * An array with all the dependencies to check.
     *
     * @var array
     */
    protected $dependenciesGithub = [
        // username/repository => current version
        'almasaeed2010/AdminLTE' => 'v2.4.3',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->dependenciesGithub as $repository => $version) {

            // clean the version
            $localVersion = $this->cleanVersion($version);
            $latestVersion = $this->getLatestVersion($repository);
            $isOutdated = Comparator::lessThan($localVersion, $latestVersion);

            if ($isOutdated) {

                // then say check the update thanks
                $this->warn('The repository '.$repository.' needs an update! '.mb_convert_encoding("\x27\x16", 'UTF-8', 'UTF-16BE').' (https://www.github.com/'.$repository.')');
                continue;
            }

            // then say it's all fine and and go to next iteration
            $this->info('The repository '.$repository.' is fine! '.mb_convert_encoding("\x27\x13", 'UTF-8', 'UTF-16BE'));
        }
    }

    /**
     * Clean the version from extra chars.
     *
     * @return string
     */
    public function cleanVersion($version)
    {
        return ltrim($version, 'v');
    }

    /**
     * Get the latest repository version from github.
     *
     * @param $repository
     */
    public function getLatestVersion($repository)
    {
        $response = \Httpful\Request::get('https://api.github.com/repos/'.$repository.'/releases/latest')->send();

        return $this->cleanVersion($response->body->tag_name);
    }
}
