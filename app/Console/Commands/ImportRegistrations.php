<?php

namespace App\Console\Commands;

use Excel;
use App\Registration;
use Illuminate\Console\Command;

class ImportRegistrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:registrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import registrations from the csvs folder';

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
        Excel::filter('chunk')
            ->load(storage_path('csvs/registrations_file.csv'))
            ->chunk(250, function($results) {
                $data = $results->map(function($e) {
                    return [
                        'id' => $e['id'],
                        'student_id' => $e['student_id'],
                        'course_id' => $e['course_id'],
                        'ano' => $e['year'],
                    ];
                });
                Registration::insert($data->toArray());
            });

        $this->info('Matrículas importadas com sucesso');
    }
}
