<x-layouts.app>
  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('compras.index')" :current="true" class="text-xl">
      {{ __('Compras') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true" class="text-xl">
      {{ __('Nueva') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="mt-6">
    <h1 class="text-2xl font-bold">{{ __('Registrar Compra') }}</h1>
  </div>

  <div class="mt-4 rounded-md p-4 shadow-md md:p-10">
    <form action="{{ route('compras.store') }}" method="POST">
      @csrf
      <div class="flex flex-col gap-6 md:flex-row md:justify-between">
        <div class="flex flex-col md:w-[50%] 2xl:w-3/5">
          <livewire:compras.buscar-proveedor />
        </div>
        <div class="mt-2 flex flex-col items-start gap-2 2xl:w-1/5">
          <span class="text-gray-700">Fecha:</span>
          <span class="font-bold">{{ now()->setTimezone('America/Bogota')->format('d/m/Y, h:i A') }}</span>
          <input type="hidden" name="fecha" value="{{ now()->format('Y-m-d') }}">
          <input type="hidden" name="estado" value="pendiente">
        </div>
        <div class="flex flex-row items-center justify-end gap-3 2xl:w-1/5">
          <a href="{{ route('compras.create') }}" class="btn-secundary">Limpiar</a>
          <button type="submit" class="btn-primary">{{ __('Registrar Compra') }}</button>
        </div>
      </div>

      <div class="mt-6 border border-gray-200 p-4">
        <livewire:compras.buscar-producto />
      </div>

    </form>
  </div>
</x-layouts.app>