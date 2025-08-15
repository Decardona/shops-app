<x-layouts.app>
  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('ventas.index')" :current="true" class="text-xl">
      {{ __('Ventas') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true" class="text-xl">
      {{ __('Nueva') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="mt-6">
    <h1 class="text-2xl font-bold">{{ __('Registrar Venta') }}</h1>
  </div>

  <div class="mt-4 rounded-md p-4 shadow-md md:p-10">
    <form action="{{ route('ventas.store') }}" method="POST">
      @csrf
      <div class="flex flex-col gap-6 md:flex-row md:justify-between">
        <div class="flex flex-col md:w-[50%] 2xl:w-3/5">
          <livewire:ventas.buscar-tercero />
        </div>
        <div class="mt-2 flex flex-col items-start gap-2 2xl:w-1/5">
          <span class="text-gray-700">Fecha:</span>
          <span class="font-bold">{{ now()->setTimezone('America/Bogota')->format('d/m/Y, h:i A') }}</span>
        </div>
        <div class="flex flex-row items-center justify-end gap-3 2xl:w-1/5">
          <a href="{{ route('ventas.create') }}" class="btn-secundary">Limpiar</a>
          <button type="submit" class="btn-primary">{{ __('Registrar Venta') }}</button>
        </div>
      </div>

      <div class="mt-6 border border-gray-200 p-4">
        <livewire:ventas.buscar-producto />
      </div>


    </form>
  </div>
</x-layouts.app>
