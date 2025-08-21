<x-layouts.app>
  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('compras.index')">
      {{ __('Compras') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('compras.show', $compra)">
      {{ __('Compra #'.$compra->id) }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true">
      {{ __('Editar') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="mt-6">
    <h1 class="text-2xl font-bold">{{ __('Editar Compra #'.$compra->id) }}</h1>
  </div>

  <div class="mt-4 rounded-md p-4 shadow-md md:p-10">
    <form action="{{ route('compras.update', $compra) }}" method="POST">
      @csrf
      @method('PUT')
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div>
          <label for="proveedor_id" class="block text-sm font-medium text-gray-700 mb-1">Proveedor</label>
          <select name="proveedor_id" id="proveedor_id" class="input" required>
            <option value="">Seleccione un proveedor</option>
            @foreach($proveedores as $proveedor)
              <option value="{{ $proveedor->id }}" {{ $compra->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                {{ $proveedor->nombre }} {{ $proveedor->apellido }}
              </option>
            @endforeach
          </select>
          @error('proveedor_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
          <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
          <input type="date" name="fecha" id="fecha" class="input" 
                 value="{{ $compra->fecha->format('Y-m-d') }}" required>
          @error('fecha') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
          <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
          <select name="estado" id="estado" class="input" required>
            <option value="pendiente" {{ $compra->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="completada" {{ $compra->estado == 'completada' ? 'selected' : '' }}>Completada</option>
            <option value="cancelada" {{ $compra->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
          </select>
          @error('estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="flex justify-end space-x-2">
        <a href="{{ route('compras.show', $compra) }}" class="btn-secundary">Cancelar</a>
        <button type="submit" class="btn-primary">{{ __('Actualizar Compra') }}</button>
      </div>
    </form>
  </div>

  @if($compra->detalles->count() > 0)
    <div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-bold">Productos en esta compra</h2>
        <p class="text-sm text-gray-600">Para modificar productos, es recomendable crear una nueva compra.</p>
      </div>
      
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
        </table>
      </div>
    </div>
  @endif
</x-layouts.app>
