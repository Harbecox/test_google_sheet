<?php

namespace App\Http\Controllers;

use App\Models\ExportSetting;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Record::query()->paginate(20);
        $export_setting = ExportSetting::query()->first();
        return view('records.index', compact('records','export_setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('records.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'author' => 'nullable|string',
            'status' => 'required|in:Allowed,Prohibited',
            'category' => 'nullable|string',
            'views' => 'nullable|integer',
        ]);

        Record::create($data);
        return redirect()->route('records.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('records.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        return view('records.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'author' => 'nullable|string',
            'status' => 'required|in:Allowed,Prohibited',
            'category' => 'nullable|string',
            'views' => 'nullable|integer',
        ]);

        $record->update($data);
        return redirect()->route('records.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        $record->delete();
        return redirect()->route('records.index');
    }

    // Генерация 1000 строк
    public function generate()
    {
        Record::factory(1000)->create();
        return redirect()->route('records.index');
    }

    // Удаление всех записей
    public function truncate()
    {
        Record::query()->truncate();
        return redirect()->route('records.index');
    }
    public function export_settings(Request $request){
        $export_setting = ExportSetting::query()->firstOrNew();
        $export_setting->google_sheet_url = $request->google_sheet_url;
        $export_setting->google_sheet_name = $request->google_sheet_name;
        $export_setting->save();
        return redirect()->route('records.index');
    }
}
