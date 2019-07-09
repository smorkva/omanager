<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class importController extends Controller {
    public function index(Request $request) {
        return view('report.index');
    }
}
