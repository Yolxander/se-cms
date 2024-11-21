<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ListModelsContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list:models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output the content of all Laravel models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelsPath = app_path('Models'); // Update path if models are not in the "Models" folder

        if (!File::exists($modelsPath)) {
            $this->error("Models folder not found at $modelsPath.");
            return;
        }

        $files = File::allFiles($modelsPath);

        foreach ($files as $file) {
            $this->info("Model: {$file->getFilename()}");
            $this->line(File::get($file->getPathname()));
            $this->line('---------------------------------------');
        }
    }
}
