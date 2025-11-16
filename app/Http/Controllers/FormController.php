<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Demonstrates how to render and process a simple form submission.
 */
class FormController extends Controller
{
    /**
     * Display the example form view.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('form');
    }

    /**
     * Handle the posted form data and echo the submitted text.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function processSubmission(Request $request)
    {
        return $request->input('message');
    }
}
