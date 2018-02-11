<?php

namespace App\Console\Commands;

use Excel;
use App\Student;
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
        Excel::filter('chunk')
            ->load(storage_path('csvs/students_file.csv'))
            ->chunk(250, function($results) {
                $data = $results->map(function($e) {
                    return [
                        'id' => $e['id'],
                        'nome' => $e['name'],
                        'cpf' => $e['cpf'],
                        'rg' => $e['rg'],
                        'telefone' => $e['phone'],
                        'nascimento' => $e['birthday'],
                    ];
                });
                Student::insert($data->toArray());
            });
        
        $this->info('Alunos importados com sucesso');
    }
}
