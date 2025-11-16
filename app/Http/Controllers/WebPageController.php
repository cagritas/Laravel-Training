<?php

namespace App\Http\Controllers;

/**
 * Handles simple static marketing/landing page rendering.
 */
class WebPageController extends Controller
{
    /**
     * Show the sample landing page with dynamic headline text.
     *
     * @return \Illuminate\View\View
     */
    public function showLandingPage()
    {
        $pageContent = [
            'headline' => 'CagriTas',
            'subheading' => 'Hello',
        ];

        return view('web', $pageContent);
    }
}
