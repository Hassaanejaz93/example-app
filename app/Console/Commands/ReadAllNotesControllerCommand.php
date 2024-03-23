<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ReadAllNotesControllerCommand extends Command
{
    protected $signature = 'command:read-all-notes-controller';

    protected $description = 'Create a NoteController with read all notes method';

    public function handle()
    {
        // Generate NoteController using Artisan command
        Artisan::call('make:controller NoteController --resource');

        // Append code to read all notes from MySQL database in the generated controller
        $controllerPath = app_path('Http/Controllers/NoteController.php');
        $controllerContent = File::get($controllerPath);

        $readAllMethodCode = <<<EOT
public function index()
{
    \$notes = Note::all();
    return response()->json(\$notes);
}
EOT;

        $updatedContent = str_replace('//', $readAllMethodCode, $controllerContent);
        File::put($controllerPath, $updatedContent);

        $this->info('NoteController created with read all notes method.');
    }
}