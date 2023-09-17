<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOptionDDLrequest;
use App\Models\ColumnOption;
use App\Models\ColumnType;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function columnTypesGet()
    {
        $allColumnTypes  = ColumnType::all();
        return view('columnMng.get-column-types', compact('allColumnTypes'));
    }

    public function columnTypesPost(Request $request)
    {
        $allColumnTypes = ColumnType::all();
        foreach ($allColumnTypes as $column) {
            $columnName = $column->colName;
            $column->colType = $request->input($columnName);
            $column->save();
        }
        return back();
    }
    public function columnDDLGet()
    {
        $allColumnNames  = ColumnType::where('colType', 'ddl')->pluck('colName')->all();
        return view('columnMng.get-column-ddl', compact('allColumnNames'));
    }

    public function columnDDLPost(AddOptionDDLrequest $reuqest)
    {
        $newColOption  = new ColumnOption();
        $newColOption->colName  = $reuqest->theDDL;
        $selectedOption = $newColOption->colName;
        $newColOption->colOption  =  $reuqest->theDDLOption;
        $newColOption->save();
        return back()->with(['selectedOption' => $selectedOption]);
    }
}
