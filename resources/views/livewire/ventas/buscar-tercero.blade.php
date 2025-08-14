<div>
  <label for="tercero-search" class="block text-sm font-medium text-gray-700">Buscar cliente</label>
  <div class="relative mt-1">
    <div class="rounded-md focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500">
      <input type="text" id="tercero-search" wire:model.live="search" autocomplete="off"
        class="w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-yellow-500 focus:outline-none focus:ring-yellow-500"
        placeholder="Nombre o cédula...">
    </div>


    @if ($search && count($sugerencias) > 0)
      <ul class="absolute z-10 mt-1 w-full rounded-md border border-gray-200 bg-white shadow-lg">
        @foreach ($sugerencias as $tercero)
          <li wire:click="seleccionarTercero({{ $tercero->id }})"
            class="cursor-pointer px-4 py-2 text-gray-500 hover:bg-yellow-500/20">
            {{ $tercero->nombre }} {{ $tercero->apellido }} <span
              class="text-xs text-gray-500">({{ $tercero->documento }})</span>
          </li>
        @endforeach
      </ul>
    @endif

    @if ($tercero_id)
      <input type="hidden" name="tercero_id" value="{{ $tercero_id }}">
      <div class="mt-2 text-sm">Cliente seleccionado: <strong>{{ $selected_name }}</strong></div>
    @endif
  </div>
</div>
