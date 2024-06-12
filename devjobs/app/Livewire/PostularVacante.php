<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacante;

    protected $rules=[
        'cv' => 'required|mimes:pdf',
    ];

    public function mount(Vacante $vacante){
        $this->vacante = $vacante;
    }

    public function postularme(){

        $datos= $this->validate();
        //Almacenar la imagen
        $cv=$this->cv->store('public/cv');
        $datos['cv']=str_replace('public/cv/','',$cv);

        //crear el candidato
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
             'cv'=>$datos['cv']
        ]);

        //crear notificacion y enviar email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id,$this->vacante->titulo,auth()->user()->id));
        //mostrar al usuario que se envio correctamene
        session()->flash('mensaje','Se envió correctamente tu informacion, mucha suerte');
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
