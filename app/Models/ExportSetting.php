<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'google_sheet_url',
        'google_sheet_name',
    ];
}
