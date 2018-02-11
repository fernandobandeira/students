<?php

namespace App\Console\Commands;

use DB;
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
        $bar = $this->output->createProgressBar();

        if(($handle = fopen(storage_path('csvs/registrations_file.csv'), 'r')) !== false) {
            $header = fgetcsv($handle);
            $row = fgetcsv($handle);
            while($row !== false) {
                $registration = explode(';', $row[0]);
                Registration::create([
                    'id' => $registration[0],
                    'student_id' => $registration[1],
                    'course_id' => $registration[2],
                    'ano' => $registration[3],
                ]);
                $row = fgetcsv($handle);

                $bar->advance();
            }
            fclose($handle);
        }

        DB::select("SELECT setval(pg_get_serial_sequence('registrations', 'id'), coalesce(max(id) + 1,1), false) FROM registrations;");
        $bar->finish();
    }
}
