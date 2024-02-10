<?php

namespace App\Http\Livewire;

use App\Models\Tiempo;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Actividade;

class Actividades extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $user_id, $descripcion, $estado, $horas, $fecha, $actividad_id;
    public $tiempos = [];
    public $mostrarFormulario = false;
    public $totalHoras = 0;

    public $errorMessage = '';

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';

        $actividades = Actividade::where('user_id', auth()->user()->id)
            ->where(function ($query) use ($keyWord) {
                $query->where('descripcion', 'LIKE', $keyWord)
                    ->orWhere('estado', 'LIKE', $keyWord);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.actividades.view', compact('actividades'));
    }


    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->user_id = null;
        $this->descripcion = null;
        $this->estado = null;
        $this->fecha = null;
        $this->horas = null;
        $this->mostrarFormulario = false;
        $this->errorMessage = false;
    }

    public function store()
    {
        $this->validate([
            'descripcion' => 'required'
        ]);

        Actividade::create([
            'user_id' => auth()->user()->id,
            'descripcion' => $this->descripcion,
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Actividad creada con éxito.');
    }

    public function edit($id)
    {
        $record = Actividade::findOrFail($id);
        $this->selected_id = $id;
        $this->user_id = $record->user_id;
        $this->descripcion = $record->descripcion;
        $this->estado = $record->estado;
    }

    public function getTimes($id)
    {
        $this->actividad_id = $id;
        $this->tiempos = Tiempo::where('actividad_id', $id)->get();
        $this->totalHoras = $this->tiempos->sum('horas');
    }

    public function showForm()
    {
        $this->mostrarFormulario = !$this->mostrarFormulario;
    }

    public function saveTime()
    {
        $this->validate([
            'horas' => 'required|integer',
            'fecha' => 'required',
        ]);

        $totalHoras = Tiempo::where('actividad_id', $this->actividad_id)->sum('horas');

        if (($totalHoras + $this->horas) > 8) {
            $this->errorMessage =('No se pueden agregar más horas, ya se alcanzó el límite de 8 horas para esta actividad.');
            return;
        }

        Tiempo::create([
            'actividad_id' => $this->actividad_id,
            'fecha' => $this->fecha,
            'horas' => $this->horas
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Tiempo agregado con éxito.');
    }


    public function update()
    {
        $this->validate([
            'descripcion' => 'required',
            'estado' => 'required',
        ]);

        if ($this->selected_id) {
            $record = Actividade::find($this->selected_id);
            $record->update([
                /* 'user_id' => $this-> user_id, */
                'descripcion' => $this->descripcion,
                'estado' => $this->estado
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('message', 'Actividade Successfully updated.');
        }



    }

    public function destroy($id)
    {
        if ($id) {
            Actividade::where('id', $id)->delete();
        }
    }
}
