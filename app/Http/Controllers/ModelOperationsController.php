<?php

namespace App\Http\Controllers;

use App\Models\InformationEntry;

/**
 * Provides CRUD-style examples using the Eloquent model layer.
 */
class ModelOperationsController extends Controller
{
    /**
     * Retrieve a single sample record and output its content.
     *
     * @return void
     */
    public function listEntries()
    {
        // InformationEntry::get();
        // $singleEntry = InformationEntry::where('id', 2)->first();
        // $singleEntry = InformationEntry::whereId(2)->first();
        // $singleEntry = InformationEntry::whereContent('This is example text #2')->first();
        $singleEntry = InformationEntry::find(2);

        if (! $singleEntry) {
            echo 'No record found.';
            return;
        }

        echo $singleEntry->content;
    }

    /**
     * Create a record to demonstrate the create helper.
     *
     * @return void
     */
    public function add()
    {
        InformationEntry::create([
            'content' => 'This text has been inserted via the model add action.',
        ]);

        echo 'Record created!';
    }

    /**
     * Update a sample record to showcase the update helper.
     *
     * @return void
     */
    public function updateRecord()
    {
        $entry = InformationEntry::find(5);

        if (! $entry) {
            echo 'Record not found for update.';
            return;
        }

        $entry->update([
            'content' => 'This text has been updated via the model update action.',
        ]);

        echo 'Record updated!';
    }

    /**
     * Delete a record to demonstrate model-based deletions.
     *
     * @return void
     */
    public function delete()
    {
        $entry = InformationEntry::find(4);

        if (! $entry) {
            echo 'Record not found for deletion.';
            return;
        }

        $entry->delete();

        echo 'Record deleted!';
    }
}
