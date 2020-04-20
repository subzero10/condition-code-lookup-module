<?php

/*
 * This file is part of CarePlan Manager by CircleLink Health.
 */

namespace subzero10\ConditionCodeLookup\Console\Commands;

use Illuminate\Console\Command;
use subzero10\ConditionCodeLookup\ConditionCodeLookup;
use subzero10\ConditionCodeLookup\Services\ConditionCodeLookupService;
use Symfony\Component\Console\Input\InputArgument;

class LookupCondition extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Look up condition codes.';
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lookup:condition';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $type       = $this->argument('type');
        $acceptable = ['icd9', 'icd10', 'snomed', 'any'];
        if ( ! in_array($type, $acceptable)) {
            $this->error('Invalid type. Only one of icd9, icd10, snomed or any accepted');

            return;
        }

        $code = $this->argument('code');

        /** @var ConditionCodeLookup $service */
        $service = app(ConditionCodeLookupService::class);
        $lookup  = $service->{$type}($code);
        $result  = json_encode($lookup);
        $this->info("Result: $result");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['type', InputArgument::REQUIRED, 'icd9, icd10, snomed, any'],
            ['code', InputArgument::REQUIRED, 'The code to search for.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
        ];
    }
}
