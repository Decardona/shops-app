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
    <form action="{{ route('ventas.start_search', ['tipo_busqueda' => 'codigo_factura']) }}" method="POST" class="mb-8">
      @csrf
      <div class="flex flex-row gap-6">
        <flux:input type="text" label="Código de factura" name="codigo_factura" placeholder="Código de factura"
          class="md:min-w-[350px]" required />
        <div class="flex flex-col justify-end">
          <button type="submit" class="btn-primary">Buscar</button>
        </div>
      </div>
    </form>

    <!-- Formulario 2: Buscar por tercero y fecha -->
    <form action="{{ route('ventas.start_search', ['tipo_busqueda' => 'tercero_fecha']) }}" method="POST">
      @csrf
      <div class="flex flex-col gap-6 md:flex-row md:justify-between">
        <div class="flex flex-col md:min-w-[450px]">
          <livewire:ventas.buscar-tercero />
        </div>
        <div class="flex flex-col items-start justify-start gap-1 2xl:w-1/5">
          <span class="text-sm text-gray-700">Fecha:</span>
          <div class="rounded-md border border-gray-200 shadow-sm">
            <input type="date" name="fecha_compra"
              class="rounded-md px-3 py-2 focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500"
              required />
          </div>
        </div>
        <div class="flex flex-row items-center justify-center gap-3 2xl:w-1/5">
          <a href="{{ route('search_factura') }}" class="btn-secundary">Limpiar</a>
          <button type="submit" class="btn-primary">Buscar</button>
        </div>
      </div>
    </form>
  </div>
  <div class="mt-3">
    @if (isset($results) && $results->count() > 0)
      <table class="min-w-full divide-y divide-gray-200 rounded-md shadow-md">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Fecha</th>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Cliente</th>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Valor</th>
            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
          @foreach ($results as $venta)
            <tr>
              <td class="px-4 py-2">
                <flux:tooltip content="Ver Factura">
                  <a href="{{ route('ventas.imprimir', ['id' => $venta->id, 'from' => 'search']) }}"
                    class="font-semibold hover:text-yellow-500">{{ $venta->id }}
                  </a>
                </flux:tooltip>
              </td>
              <td class="px-4 py-2">{{ date('d/m/Y, h:i A', strtotime($venta->fecha)) }}</td>
              <td class="px-4 py-2">{{ $venta->tercero->nombre }} {{ $venta->tercero->apellido }}</td>
              <td class="px-4 py-2">${{ number_format($venta->total, 2) }}</td>
              <td class="px-4 py-2">
                <div class="flex flex-row gap-4">
                  <a href="{{ route('ventas.imprimir', ['id' => $venta->id, 'from' => 'search']) }}"
                    class="btn-primary-grid">Ver</a>
                  <form action="{{ route('productos.destroy', $venta) }}" method="POST" class="delete-form"
                    data-item-name="{{ 'la venta No: ' . $venta->id . ' del cliente ' . $venta->tercero->nombre . ' ' . $venta->tercero->apellido }}"
                    data-action="Anular">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-secundary-grid flex items-center gap-1">
                      <flux:icon name="trash" class="h-4 w-4" />
                      Anular
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      @if (isset($results) && $results->count() === 0)
        <p>No se encontraron resultados.</p>
      @endif
    @endif
  </div>
</x-layouts.app>
