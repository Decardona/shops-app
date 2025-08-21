<x-layouts.app>
  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('compras.index')">
      {{ __('Compras') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true">
      {{ __('Compra #'.$compra->id) }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="max-w-4xl mx-auto mt-8">
    <div class="mb-6 p-6 bg-white rounded-lg shadow">
      <h2 class="text-xl font-bold mb-4">Información de la compra</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <p class="text-sm text-gray-600">Proveedor</p>
          <p class="font-semibold">{{ $compra->proveedor->nombre ?? '' }} {{ $compra->proveedor->apellido ?? '' }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Fecha</p>
          <p class="font-semibold">{{ $compra->fecha->format('d/m/Y') }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Estado</p>
          <span class="px-2 py-1 text-xs font-semibold rounded-full 
            {{ $compra->estado == 'completada' ? 'bg-green-100 text-green-800' : 
               ($compra->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
            {{ ucfirst($compra->estado) }}
          </span>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-bold">Productos comprados</h2>
      </div>
      
      @if($compra->detalles->count() > 0)
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Unitario</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($compra->detalles as $detalle)
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $detalle->producto->nombre ?? 'Producto no encontrado' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ number_format($detalle->cantidad) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    ${{ number_format($detalle->precio, 2) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    ${{ number_format($detalle->cantidad * $detalle->precio, 2) }}
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot class="bg-gray-50">
              <tr>
                <td colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-900">
                  Total de la compra:
                </td>
                <td class="px-6 py-3 text-sm font-bold text-gray-900">
                  ${{ number_format($compra->detalles->sum(function($detalle) { return $detalle->cantidad * $detalle->precio; }), 2) }}
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      @else
        <div class="text-center py-8">
          <p class="text-gray-500">No hay productos en esta compra.</p>
        </div>
      @endif
    </div>

    <div class="mt-6 flex justify-between">
      <a href="{{ route('compras.index') }}" class="btn-secundary">
        Volver a compras
      </a>
      <div class="space-x-2">
        <a href="{{ route('compras.edit', $compra) }}" class="btn-primary">
          Editar compra
        </a>
      </div>
    </div>
  </div>
</x-layouts.app>
