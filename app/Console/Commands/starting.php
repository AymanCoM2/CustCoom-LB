<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class starting extends Command
{

    protected $signature = 'app:starting';
    // php artisan app:starting

    protected $description = 'Command description';

    public function handle()
    {
        $adminUser = new User();
        $adminUser->name = 'admin';
        $adminUser->email = 'alshimaa.abdallah@2coom.com';
        $adminUser->password = Hash::make('123');
        $adminUser->isSuperUser = 1;
        $adminUser->email_verified_at = now();
        $adminUser->save();
        // 3 ->Viewer , 2->Editor , 1->Admin

        $editorUser = new User();
        $editorUser->name = 'Abdelrahman';
        $editorUser->email = 'abdelrahman.maged@2coom.com';
        $editorUser->password = Hash::make('123');
        $editorUser->isSuperUser = 2;
        $editorUser->email_verified_at = now();
        $editorUser->save();



        $editorUser2 = new User();
        $editorUser2->name = 'Asmaa';
        $editorUser2->email = 'as.yahiya.2coom@gmail.com';
        $editorUser2->password = Hash::make('123');
        $editorUser2->isSuperUser = 2;
        $editorUser2->email_verified_at = now();
        $editorUser2->save();



        $viewerUser = new User();
        $viewerUser->name = 'Osama';
        $viewerUser->email = 'osama.saad@2coom.com';
        $viewerUser->password = Hash::make('123');
        $viewerUser->isSuperUser = 3;
        $viewerUser->email_verified_at = now();
        $viewerUser->save();


        $viewerUser2 = new User();
        $viewerUser2->name = 'Mahmoud';
        $viewerUser2->email = 'mahmoud.saleh@2coom.com';
        $viewerUser2->password = Hash::make('123');
        $viewerUser2->isSuperUser = 3;
        $viewerUser2->email_verified_at = now();
        $viewerUser2->save();
    }
}
