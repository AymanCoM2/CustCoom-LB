<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('author', function () {
    $this->comment("Ayman Salah");
})->purpose('Display The author Name');
// $ php artisan author   {Command}
// Ayman Salah {Result}