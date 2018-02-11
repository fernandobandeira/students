<?php

namespace App\Console\Commands;

use Excel;
use App\Course;
use Illuminate\Console\Command;

class ImportCourses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:courses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import courses from the csvs folder';

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
            ->load(storage_path('csvs/courses_file.csv'))
            ->chunk(250, function($results) {
                $data = $results->map(function($e) {
                    return [
                        'id' => $e['id'],
                        'nome' => $e['course_name'],
                        'mensalidade' => $e['monthly_amount'],
                        'valor_matricula' => $e['registration_tax'],
                        'periodo' => $e['period'],
                        'duracao' => $e['duration'],
                    ];
                });
                Course::insert($data->toArray());
            });

        $this->info('Cursos importados com sucesso');
    }
}
