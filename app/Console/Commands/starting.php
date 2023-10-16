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
        $adminUser->email = 'admin@admin.com';
        $adminUser->password = Hash::make('123');
        $adminUser->isSuperUser = 1;
        $adminUser->email_verified_at = now();
        $adminUser->save();
        // 3 ->Viewer , 2->Editor , 1->Admin

        $editorUser = new User();
        $editorUser->name = 'editor';
        $editorUser->email = 'editor@editor.com';
        $editorUser->password = Hash::make('123');
        $editorUser->isSuperUser = 2;
        $editorUser->email_verified_at = now();
        $editorUser->save();

        $viewerUser = new User();
        $viewerUser->name = 'viewer';
        $viewerUser->email = 'viewer@viewer.com';
        $viewerUser->password = Hash::make('123');
        $viewerUser->isSuperUser = 3;
        $viewerUser->email_verified_at = now();
        $viewerUser->save();
    }
}
