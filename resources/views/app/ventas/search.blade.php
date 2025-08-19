<x-layouts.app>
  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('ventas.create')" :current="true" class="text-xl">
      {{ __('Ventas') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true" class="text-xl">
      {{ __('Buscador') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="mt-6">
    <h1 class="text-2xl font-bold">{{ __('Buscar Venta') }}</h1>
  </div>

  <div class="mt-4 rounded-md p-4 shadow-md md:p-10">
    <!-- Formulario 1: Buscar por código de factura -->
    <form action="{{ route('ventas.start_search') }}" method="GET" class="mb-8">
      <div class="flex flex-row gap-6">
        <flux:input type="text" label="Código de factura" name="codigo_factura" placeholder="Código de factura"
          class="md:min-w-[350px]" />
        <div class="flex flex-col justify-end">
          <button type="submit" class="btn-primary">Buscar</button>
        </div>
      </div>
    </form>

    <!-- Formulario 2: Buscar por tercero y fecha -->
    <form action="{{ route('ventas.start_search') }}" method="GET">
      <div class="flex flex-col gap-6 md:flex-row md:justify-between">
        <div class="flex flex-col md:min-w-[450px]">
          <livewire:ventas.buscar-tercero />
        </div>
        <div class="flex flex-col items-start justify-start gap-1 2xl:w-1/5">
          <span class="text-sm text-gray-700">Fecha:</span>
          <div class="rounded-md border border-gray-200 shadow-sm">
            <input type="date" name="fecha_compra"
              class="rounded-md px-3 py-2 focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500" />
          </div>
        </div>
        <div class="flex flex-row items-center justify-center gap-3 2xl:w-1/5">
          <a href="{{ route('ventas.create') }}" class="btn-secundary">Limpiar</a>
          <button type="submit" class="btn-primary">Buscar</button>
        </div>
      </div>
    </form>
  </div>
</x-layouts.app>
