<?php

namespace App\Console\Commands;

use App\Course;
use DB;
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
        $bar = $this->output->createProgressBar();

        if (($handle = fopen(storage_path('csvs/courses_file.csv'), 'r')) !== false) {
            $header = fgetcsv($handle);
            $courses = [];
            $row = fgetcsv($handle);
            $cont = 0;
            while ($row !== false) {
                $courses[] = [
                    'id'              => $row[0],
                    'nome'            => $row[1],
                    'mensalidade'     => $row[2],
                    'valor_matricula' => $row[3],
                    'periodo'         => $row[4],
                    'duracao'         => $row[5],
                ];
                $cont++;
                $row = fgetcsv($handle);

                if ($cont === 250 || $row === false) {
                    $cont = 0;
                    Course::insert($courses);
                    $courses = [];
                }

                $bar->advance();
            }
            fclose($handle);
        }

        $bar->finish();
        DB::select("SELECT setval(pg_get_serial_sequence('courses', 'id'), coalesce(max(id) + 1,1), false) FROM courses;");
    }
}
