<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Procedure;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departmentColors = [
            'Sales' => 'cyan',
            'Dispatch' => 'lime',
            'Assembly' => 'violet',
            'default' => 'gray',
        ];

        $departments = Department::with(['procedures' => function ($query) {
            $query->latest()->limit(5);
        }])->get();

        return view('procedures.index', [
            'departments' => $departments,
            'departmentColors' => $departmentColors,
        ]);
    }

    public function byDepartment(Department $department)
    {
        $departmentColors = [
            'Sales' => 'cyan',
            'Dispatch' => 'lime',
            'Assembly' => 'violet',
            'default' => 'gray',
        ];
        // Eager load the 'user' for each procedure in the department
        $procedures = $department->procedures()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('procedures.by-department', [
            'department' => $department,
            'procedures' => $procedures,
            'departmentColors' => $departmentColors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();

        return view('procedures.create', [
            'departments' => $departments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'body' => ['required', 'string'],
            'department_id' => ['required', 'exists:departments,id'],
        ]);

        $procedure = Procedure::create([
            ...$data,
            'user_id' => auth()->user()->id,
        ]);

        return to_route('procedures.show', $procedure)->with('success', 'Procedure created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Procedure $procedure)
    {
        return view('procedures.show', [
            'procedure' => $procedure,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Procedure $procedure)
    {
        $this->authorize('is-manager', $procedure);

        $departments = Department::all();

        return view('procedures.edit', [
            'procedure' => $procedure,
            'departments' => $departments,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Procedure $procedure)
    {
        $this->authorize('is-manager', $procedure);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'body' => ['required', 'string'],
            'department_id' => ['required', 'exists:departments,id'],
        ]);

        $procedure->update($data);

        return to_route('procedures.show', $procedure)->with('success', 'Procedure updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Procedure $procedure)
    {
        $this->authorize('delete', $procedure);

        $procedure->delete();

        return to_route('procedures.index')->with('success', 'Procedure deleted');
    }
}
