<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackUpController extends Controller
{
    public function getBackupView()
    {
        return view('pages.backup-data');
    }

    public function exportAllDataHandler(Request $request)
    {
        // modify stuff
        dd('v');
        // You already Have a File with the Calculation Fields For It 
        # You Get it and then Put the SAP && MySQL Fields 
        # Check All Data Are Ok And Coming From the Fields "Old Not What If Data" 
        # Then Make Sure you Can RE_Cycle the Data 
        # This Means that you Can then Get the Cyccle Again and Feed the Exported File as New Backup 
    }
}


// 1- Get Data From Sap ; 
// 2- Get Data From MySQL DB  ; 
// 3- Calculate the Calculated Data  ; ?????
# 1 Approach Number 1 -> Collect All Data into One Collection and Export them Then Truncate Model 
# 2 