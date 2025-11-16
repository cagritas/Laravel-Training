<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Contains raw query builder samples for insert/update/delete/read actions.
 */
class DatabaseOperationsController extends Controller
{
    /**
     * Insert a new record via the query builder.
     *
     * @return void
     */
    public function insert()
    {
        DB::table('information_entries')->insert([
            'content' => 'This is the third example text inserted with the query builder.',
        ]);
    }

    /**
     * Update an existing record using the query builder.
     *
     * @return void
     */
    public function updateRecord()
    {
        DB::table('information_entries')->where('id', 1)->update([
            'content' => 'This example text has been updated using the query builder.',
        ]);
    }

    /**
     * Delete an example record.
     *
     * @return void
     */
    public function delete()
    {
        DB::table('information_entries')->where('id', 1)->delete();
    }

    /**
     * Fetch and display a single record.
     *
     * @return void
     */
    public function showRecords()
    {
        // $records = DB::table('information_entries')->get();

        // foreach ($records as $key => $record) {
        //     echo $record->content;
        //     echo "<br>";
        // }

        // print_r($records);

        $record = DB::table('information_entries')->where('id', 3)->first();

        if (! $record) {
            echo 'No record found.';
            return;
        }

        echo $record->content;
    }
}
