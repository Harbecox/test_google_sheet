<?php

namespace App;

use App\Models\ExportSetting;
use Revolution\Google\Sheets\Facades\Sheets;

class Helper
{
    static function getGoogleSheet()
    {
        $setting = ExportSetting::first();
        if (!$setting) {
            throw new \Error('Ссылка на Google Sheet не указана');
        }

        preg_match('/\/spreadsheets\/d\/([a-zA-Z0-9-_]+)/', $setting->google_sheet_url, $matches);
        if (!isset($matches[1])) {
            throw new \Error('Неверный формат URL');
        }

        $spreadsheetId = $matches[1];
        $sheetName = $setting->google_sheet_name;
        $spreadsheet = Sheets::spreadsheet($spreadsheetId);
        if(!in_array($sheetName,$spreadsheet->sheetList())){
            throw new \Error('Лист не найден!');
        }
        return $spreadsheet->sheet($sheetName);
    }
}
