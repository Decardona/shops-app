<div>
  <div class="mb-6">
    <label for="producto-search" class="block text-sm font-medium text-gray-700">Buscar producto</label>
    <div class="relative mt-1">
      <div class="rounded-md focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500"><input
          type="text" id="producto-search" wire:model.live="search" autocomplete="off"
          wire:keydown.arrow-down="seleccionarSiguiente" wire:keydown.arrow-up="seleccionarAnterior"
          wire:keydown.enter.prevent="seleccionarActual"
          class="w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-yellow-500 focus:outline-none focus:ring-yellow-500"
          placeholder="Nombre, SKU o código..."></div>

      @if ($search && count($sugerencias) > 0)
        <ul class="absolute z-10 mt-1 w-full rounded-md border border-gray-200 bg-white shadow-lg">
          @foreach ($sugerencias as $i => $producto)
            <li wire:click="agregarProducto({{ $producto->id }})"
              class="{{ $i === $sugerenciaSeleccionada ? 'bg-yellow-200 font-bold' : '' }} cursor-pointer px-4 py-2 hover:bg-yellow-100">
              {{ $producto->nombre }} <span class="text-xs text-gray-500">({{ $producto->sku }})</span> -
              ${{ number_format($producto->precio, 0, ',', '.') }}
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>

  @if (count($productosSeleccionados) > 0)
    <div class="mt-6 overflow-x-auto">
      <table class="w-full border text-sm text-gray-700">
        <thead class="bg-gray-50">
          <tr>
            <th class="text-start">Nombre</th>
            <th class="text-start">SKU</th>
            <th class="text-start">Precio</th>
            <th class="text-start">Cantidad</th>
            <th class="text-start">Subtotal</th>
            <th class="text-start"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($productosSeleccionados as $i => $prod)
            <tr>
              <td>{{ $prod['nombre'] }}</td>
              <td>{{ $prod['sku'] }}</td>
              <td>${{ number_format($prod['precio'], 0, ',', '.') }}</td>
              <td>
                <input type="number" min="1"
                  wire:change="actualizarCantidad({{ $i }}, $event.target.value)"
                  value="{{ $prod['cantidad'] }}" class="w-16 rounded border px-2 py-1">
              </td>
              <td>${{ number_format($prod['subtotal'], 0, ',', '.') }}</td>
              <td>
                <button type="button" wire:click="eliminarProducto({{ $i }})"
                  class="cursor-pointer font-bold text-yellow-600 hover:underline">Eliminar</button>
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="text-right font-bold">Total:</td>
            <td colspan="2" class="font-bold">${{ number_format($total, 0, ',', '.') }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  @endif
</div>
