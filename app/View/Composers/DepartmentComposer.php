<?php

namespace App\View\Composers;

use App\Models\Department;
use Illuminate\View\View;

class DepartmentComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view): void
    {
        // Fetch all departments (ordered by name) and share them with the view.
        // We add caching here for better performance so we don't query the database on every page load.
        $departments = cache()->remember('all_departments', now()->addHour(), function () {
            return Department::orderBy('name')->get();
        });

        // The 'with' method makes the $departments variable available in the view.
        $view->with('departments', $departments);
    }
}
