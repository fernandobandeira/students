<?php

namespace App\Console\Commands;

use App\Student;
use DB;
use Illuminate\Console\Command;

class ImportStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import students from the csvs folder';

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

        if (($handle = fopen(storage_path('csvs/students_file.csv'), 'r')) !== false) {
            $header = fgetcsv($handle);
            $students = [];
            $row = fgetcsv($handle);
            $cont = 0;
            while ($row !== false) {
                $student = explode(';', $row[0]);
                $students[] = [
                    'id'         => $student[0],
                    'nome'       => $student[1],
                    'cpf'        => $student[2],
                    'rg'         => $student[3],
                    'telefone'   => $student[4],
                    'nascimento' => $student[5],
                ];
                $cont++;
                $row = fgetcsv($handle);

                if ($cont === 250 || $row === false) {
                    $cont = 0;
                    Student::insert($students);
                    $students = [];
                }

                $bar->advance();
            }
            fclose($handle);
        }

        DB::select("SELECT setval(pg_get_serial_sequence('students', 'id'), coalesce(max(id) + 1,1), false) FROM students;");
        $bar->finish();
    }
}
