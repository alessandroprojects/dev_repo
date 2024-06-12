<div class=" dark:bg-slate-900 dark:text-white bg-gray-100 p--5 mt-10 flex flex-col justify-center items-center">
    <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>
    @if (session()->has('mensaje'))
        <div
            class="uppercase border border-green-800 bg-green-100 text-green-600 font-bold p-2 my-3
      dark:bg-green-600 dark:text-white ">
            {{ session('mensaje') }}
        </div>
    @else
        <form action="" wire:submit.prevent='postularme' class="w.96 mt-5">
            <div class="mb-4">
                <x-input-label for="cv" :value="__('Curriculum o Hoja de vida (PDF)')" />
                <x-text-input id="cv" class="block mt-1 w-full" type="file" wire:model="cv" accept=".pdf*" />
                <x-input-error :messages="$errors->get('cv')" class="mt-2" />
            </div>

            <x-primary-button class="my-5">
                {{ __('Postular') }}
            </x-primary-button>
        </form>
    @endif

</div>
