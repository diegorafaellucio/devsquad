<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class importproducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:importproducts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all csv files add to the system';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $files = DB::table('files')
            ->select('*')
            ->where('processed', '=', '0')
            ->get()->toArray();

        $mainPath = Storage::disk('public')->getAdapter()->getPathPrefix();

        foreach ($files as $file){
            $fileName =  "importProducts/{$file->name}";
            $filePath = "{$mainPath}{$fileName}";

            Excel::load($filePath)->each(function (Collection $csvLine) {

                Character::create([
                    'name' => "{$csvLine->get('first_name')} {$csvLine->get('last_name')}",
                    'job' => $csvLine->get('job'),
                ]);

            });
        }
    }
}
