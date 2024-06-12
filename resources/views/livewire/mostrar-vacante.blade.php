<div class="p-10">
    <div class="mb-5">
        <h3 class=" font-bold text-3xl text-gray-800 my-3 dark:text-white">
            {{ $vacante->titulo }}
        </h3>
        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-10 dark:bg-gray-900">
            <p class=" font-bold text-sm text-gray-800 my-3 dark:text-white uppercase"> Empresa <span
                    class=" normal-case font-normal">{{ $vacante->empresa }}</span></p>

            <p class="font-bold text-sm text-gray-800 my-3 dark:text-white uppercase">
                ÚLTIMO DÍA PARA POSTULARSE
                <span
                    class="normal-case font-normal">{{ \Carbon\Carbon::parse($vacante->ultimo_dia)->locale('es')->isoFormat('LL') }}</span>
            </p>

            <p class=" font-bold text-sm text-gray-800 my-3 dark:text-white uppercase"> Categoria <span
                    class=" normal-case font-normal">{{ $vacante->categoria->categoria }}</span></p>

            <p class=" font-bold text-sm text-gray-800 my-3 dark:text-white uppercase"> Salario <span
                    class=" normal-case font-normal">{{ $vacante->salario->salario }}</span></p>
        </div>
    </div>

    <div class="md:grid md:grid-cols-6 gap-4">
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/' . $vacante->imagen) }}"
                alt="{{ 'Imagen Vacante ' . $vacante->titulo }}">
        </div>

        <div class="dark:text-white md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">Descripcion del Puesto</h2>
            <p>{{ $vacante->descripcion }}</p>
        </div>
    </div>

    @guest
        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center dark:bg-gray-900 dark:text-white">
            <p>¿Deseas aplicar a esta vacante? <a href="{{ route('register') }}" class=" font-bold text-indigo-600">Obten
                    una cuenta y aplica a esta y otras vacantes</a></p>
        </div>
    @endguest

    @auth


    @if (auth()->user()->rol === 1)
        <livewire:postular-vacante :vacante="$vacante" />
    @endif
    @endauth

</div>
