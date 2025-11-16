<?php

namespace App\Http\Controllers;

/**
 * Demonstrates basic controller/view binding for the training project.
 */
class ExampleController extends Controller
{
    /**
     * Render the sample view with the provided visitor name.
     *
     * @param string $name
     * @return \Illuminate\View\View
     */
    public function show(string $name)
    {
        return view('example', ['name' => $name]);
    }
}

// class ExampleController extends Controller
// {
//     function test($name)
//     {
//         return 'Hello '. $name;
//     }
// }
