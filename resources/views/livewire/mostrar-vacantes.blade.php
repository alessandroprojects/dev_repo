<div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        @if (count($vacantes) > 0)


            @foreach ($vacantes as $vacante)
                <div
                    class="p-6 text-gray-900 dark:text-gray-100 border-gray-200 border-b md:flex md:justify-between md:items-center">
                    <div class=" space-y-3">
                        <a href="{{route('vacantes.show',$vacante->id)}}" class=" text-xl font-bold">
                            {{ $vacante->titulo }}
                        </a>
                        <p class="text-sm text-gray-600 font-bold dark:text-white">{{ $vacante->empresa }}</p>
                        <p>Ultimo dia: {{ $vacante->ultimo_dia }}</p>
                    </div>
                    <div class="flex flex-col md:flex-row  gap-3 items-stretch mt-5 md:mt-0">
                        <a href="{{route('candidatos.index',$vacante)}}"
                            class="dark:bg-white dark:text-black bg-slate-800 py-2 text-center px-4 rounded-lg text-white text-xs font-bold uppercase ">
                            {{$vacante->candidatos->count()}} Candidatos
                        </a>
                        <a href="{{ route('vacantes.edit', $vacante->id) }}"
                            class=" bg-blue-800 py-2 px-4 rounded-lg text-white text-xs  text-center font-bold uppercase ">
                            Editar
                        </a>
                        <button wire:click="$dispatch('mostrarAlerta',{{$vacante->id}})"
                            class=" bg-red-600 py-2 px-4 rounded-lg text-white text-xs  text-center font-bold uppercase ">
                            Eliminar
                        </button>
                    </div>
                </div>
            @endforeach
        @else
            <p class=" p-e text-center text-sm text-gray-600 dark:text-white ">No hay Vacantes</p>
        @endif



    </div>

    <div class="  mt-10 dark:text-white">
        {{ $vacantes->links() }}
    </div>

</div>
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('mostrarAlerta', vacanteId => {
            Swal.fire({
                title: '¿Eliminar Vacante ?',
                text: "Una vacante eliminada no se puede recuperar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    //Eliminar del servdor
                    Livewire.dispatch('eliminarVacante', [vacanteId])
                    Swal.fire(
                        'Eliminado!',
                        'La vacante a sido Eliminada.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush
