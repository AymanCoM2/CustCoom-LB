<?php

namespace App\Http\Controllers;


class WhatifController extends Controller
{
    public function whatIfApproved($cardCode)
    {
        return view('pages.what-if-frame', compact(['cardCode']));
    }
}
