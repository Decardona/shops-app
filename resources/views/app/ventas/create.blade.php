<x-layouts.app>
  @php
    $total = 0;
  @endphp

  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('ventas.index')" :current="true" class="text-xl">
      {{ __('Ventas') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true" class="text-xl">
      {{ __('Nuevo') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="mt-6">
    <h1 class="text-2xl font-bold">{{ __('Crear Nueva Venta') }}</h1>
    {{-- <p class="mt-2 text-gray-600">{{ __('Ingresa los detalles del nuevo producto a continuación.') }}</p> --}}
  </div>

  <div class="mt-4 rounded-md p-4 shadow-md md:p-10">
    <form action="{{ route('ventas.store') }}" method="POST">
      @csrf
      <div class="flex flex-col gap-6 md:flex-row md:justify-between">
        <div class="flex w-2/3 flex-col">
          <livewire:ventas.buscar-tercero />
        </div>
        <div class="mr-2 flex w-1/3 flex-row items-center justify-end gap-2">
          <span class="font-medium text-gray-700">Fecha:</span>
          <span class="font-bold">{{ now()->setTimezone('America/Bogota')->format('d/m/Y, h:i A') }}</span>
        </div>
      </div>

      <div class="mt-6 border border-gray-200 p-4">
        <livewire:ventas.buscar-producto />
      </div>

      <div class="mt-4 flex justify-end gap-3 md:col-span-2">
        <a href="{{ route('user.index') }}" class="btn-secundary">Cancelar</a>
        <button type="submit" class="btn-primary">{{ __('Registrar Venta') }}</button>
      </div>
    </form>
  </div>

</x-layouts.app>
