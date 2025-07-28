<?php

namespace App\Console\Commands;

use App\Helper;
use App\Models\ExportSetting;
use App\Models\Record;
use Illuminate\Console\Command;
use Revolution\Google\Sheets\Facades\Sheets;

class ExportRecordsToSheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-records-to-sheet';

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

        $records = Record::query()
            ->where('status', 'Allowed')
            ->select('id','title', 'description', 'author', 'status', 'category', 'views','created_at','updated_at')
            ->get()
            ->keyBy('id')
            ->toArray();


        $sheetData = $sheet->all();
        unset($sheetData[0]);
        if(count($sheetData) > 1) {
            for($i = 1; $i < count($sheetData); $i++) {
                if(isset($records[$sheetData[$i][0]])) {
                    $sheetData[$i] = array_merge($records[$sheetData[$i][0]], array_slice($sheetData[$i], count($records[$sheetData[$i][0]])));
                }else{
                    unset($sheetData[$i]);
                }
            }
            $sheetData = collect($sheetData)->map(function ($row) {
                return array_values($row);
            })->toArray();
        }else{
            $sheetData = $records;
        }

        $sheetData = collect($sheetData)
            ->map(function ($row) {
                return array_values($row);
            })
            ->values()
            ->toArray();

        $sheet->clear();
        $sheet->append([['ID', 'Title', 'Description', 'Author', 'Status', 'Category', 'Views', 'Created','Updated']]);
        $sheet->append(array_values($sheetData));
    }
}
