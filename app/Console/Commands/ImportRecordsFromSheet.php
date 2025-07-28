<?php

namespace App\Console\Commands;

use App\Helper;
use App\Models\ExportSetting;
use Illuminate\Console\Command;
use Revolution\Google\Sheets\Facades\Sheets;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ImportRecordsFromSheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-records-from-sheet {--count=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $sheet = Helper::getGoogleSheet();

        $this->info('Чтение данных из Google Sheets...');

        $rows = $sheet->get();

        if ($rows->isEmpty()) {
            $this->warn('Нет данных в таблице.');
            return CommandAlias::SUCCESS;
        }

        $count = (int) $this->option('count');
        $limitedRows = $count > 0 ? $rows->slice(0, $count) : $rows;

        $this->info("Всего строк: {$limitedRows->count()}");

        $bar = $this->output->createProgressBar($limitedRows->count());
        $bar->start();

        $header = [];
        foreach ($limitedRows as $index => $row) {
            if($index == 0){
                $header = $row;
            }else{
                $this->table($header,[$row]);

                $bar->advance();

                $this->newLine();
                $this->info("Нажмите [Enter], чтобы продолжить или [q] для выхода...");

                $key = trim(fgets(STDIN));
                if (strtolower($key) === 'q') {
                    $this->warn("Прервано пользователем.");
                    break;
                }
            }
        }

        $bar->finish();

        return CommandAlias::SUCCESS;
    }
}
