<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Customers;
use Illuminate\Support\Facades\Mail;

class DoBackup extends Command
{
    protected $signature = 'app:do-backup';

    protected $description = 'Make Data Backup,Save a Copy and Send another To Mail';

    public function handle()
    {
        $path  = "/home/ubuntu/Downloads/";
        $customers = Customers::all();
        (new FastExcel($customers))->export($path . 'Backup-TM.xlsx');
        Mail::to('alshimaa.abdallah@2coom.com')->send(new \App\Mail\ExcelFile());
        Mail::to('abdelrahman.maged@2coom.com')->send(new \App\Mail\ExcelFile());
        Mail::to('as.yahiya.2coom@gmail.com')->send(new \App\Mail\ExcelFile());
        $this->info('Email sent successfully.');
    }
}
