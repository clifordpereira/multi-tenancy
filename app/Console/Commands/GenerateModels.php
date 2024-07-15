<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateModels extends Command
{    
    protected $signature = 'make:models {models*}';
    protected $description = 'Generate multiple models and their migrations';
    
    public function handle()
    {
        $models = $this->argument('models');

        // Loop through each model and generate it with its migration
        foreach ($models as $model) {
            $this->call('make:model', ['name' => $model, '--migration' => true]);
        }

        $this->info('Models and migrations generated successfully!');
    }
}
