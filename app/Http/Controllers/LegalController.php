<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Show terms of service page
     */
    public function terms()
    {
        return view('legal.terms');
    }

    /**
     * Show privacy policy page
     */
    public function privacy()
    {
        return view('legal.privacy');
    }

    /**
     * Show disclaimer page
     */
    public function disclaimer()
    {
        return view('legal.disclaimer');
    }
}
