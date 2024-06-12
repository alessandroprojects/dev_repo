<div>
    <livewire:filtrar-bacantes />
    <div class="py-12">
        <div class=" max-w-7xl mx-auto">
            <h3 class=" font-extrabold text-4xl text-gray-700 mb-12 dark:text-white">Nuestras Vacantes Disponibles</h3>
            <div class="bg-white shadow-sm rounded-lg p-6 dark:bg-gray-700 divide-y divide-gray-200 dark:divide-white">
                @forelse ($vacantes as $vacante)
                    <div class="md:flex md:justify-between md:items-center py-5">
                        <div class="md:flex-1">
                            <a href="{{route('vacantes.show',$vacante->id)}}" class=" text-3xl font-extrabold text-gray-600 dark:text-white">{{$vacante->titulo}}</a>
                            <p class=" text-base text-gray-600 mb-1 dark:text-gray-50">{{$vacante->empresa}}</p>
                            <p class=" text-xs font-bold text-gray-600 mb-1 dark:text-gray-50">{{$vacante->categoria->categoria}}</p>
                            <p class=" text-base text-gray-600 mb-1 dark:text-gray-50">{{$vacante->salario->salario}}</p>
                            <p class=" text-gray-600 mb-3 text-xs dark:text-gray-50 font-bold">Ultimo dia para postularce:
                                <span class=" font-normal">{{ \Carbon\Carbon::parse($vacante->ultimo_dia)->locale('es')->isoFormat('LL') }}</span>
                            </p>

                        </div>
                        <div class="mt-5 md:mt-0">
                            <a class="block text-center bg-indigo-500 p-3 text-sm uppercase font-bold text-white rounded-lg" href="{{route('vacantes.show',$vacante->id)}}">Ver Vacante</a>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-center text-sm">No hay vacantes aun</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
