<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::orderBy('name')->get();
        return view('employers.index', compact('employers'));
    }

    public function show(\App\Models\Employer $employer)
    {
        $employer->load('jobs');
        return view('employers.show', compact('employer'));
    }
}
