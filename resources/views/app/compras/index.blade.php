<x-layouts.app>
  <div class="max-w-7xl mx-auto mt-8 px-4">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Compras</h2>
      <a href="{{ route('compras.create') }}" class="btn-primary">
        <flux:icon name="plus" class="w-5 h-5 mr-2" />
      
      </a>
    </div>

    <form method="GET" action="{{ route('compras.index') }}" class="mb-6">
      <div class="flex gap-4 items-end">
        <div class="flex-1">
          <label for="q" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
          <input type="text" name="q" id="q" placeholder="Buscar por proveedor..." 
                 class="input" value="{{ request('q') }}" />
        </div>
        <div>
          <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
          <select name="estado" id="estado" class="input">
            <option value="">Todos</option>
            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
            <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
          </select>
        </div>
        <div>
          <button type="submit" class="btn-secundary">Buscar</button>
        </div>
      </div>
    </form>

    @if($compras->count() > 0)
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Compra #
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Proveedor
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Fecha
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Total
              </th>
           
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($compras as $compra)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                #{{ $compra->id }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $compra->proveedor->nombre ?? 'Sin proveedor' }} {{ $compra->proveedor->apellido ?? '' }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $compra->fecha->format('d/m/Y') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                ${{ number_format($compra->detalles->sum(function($detalle) { return $detalle->cantidad * $detalle->precio; }), 2) }}
              </td>
             
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="{{ route('compras.show', $compra) }}" 
                   class="text-blue-600 hover:text-blue-900 mr-3">Ver</a>
                <a href="{{ route('compras.edit', $compra) }}" 
                   class="text-indigo-600 hover:text-indigo-900">Editar</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="mt-6">
        {{ $compras->links() }}
      </div>
    @else
      <div class="text-center py-12">
        <flux:icon name="shopping-bag" class="mx-auto h-12 w-12 text-gray-400" />
        <h3 class="mt-2 text-sm font-medium text-gray-900">No hay compras</h3>
        <p class="mt-1 text-sm text-gray-500">Comienza creando una nueva compra.</p>
        <div class="mt-6">
          <a href="{{ route('compras.create') }}" class="btn-primary">
            <flux:icon name="plus" class="w-5 h-5 mr-2" />
          
          </a>
        </div>
      </div>
    @endif
  </div>
</x-layouts.app>
