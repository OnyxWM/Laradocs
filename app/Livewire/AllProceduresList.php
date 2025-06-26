<?php

namespace App\Livewire;

use App\Models\Procedure;
use Livewire\Component;
use Livewire\WithPagination;

class AllProceduresList extends Component
{
    use WithPagination;

    public $departmentColors = [];

    public function mount($departmentColors)
    {
        $this->departmentColors = $departmentColors;
    }

    public function render()
    {
        $allProcedures = Procedure::latest()
            ->with(['user', 'department'])
            ->paginate(10);

        return view('livewire.all-procedures-list', [
            'allProcedures' => $allProcedures,
        ]);
    }
}
