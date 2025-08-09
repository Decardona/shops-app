<x-layouts.app>

  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('productos.index')" :current="true" class="text-xl">
      {{ __('Productos') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="relative mt-6 overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
      <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            Nombre
          </th>
          <th scope="col" class="px-6 py-3">
            Marca
          </th>
          <th scope="col" class="px-6 py-3">
            Categoría
          </th>
          <th scope="col" class="px-6 py-3">
            Precio
          </th>
          <th scope="col" class="px-6 py-3">
            SKU
          </th>
          <th scope="col" class="px-6 py-3">
            Existencia
          </th>
          <th scope="col" class="px-6 py-3">
            Acciones
          </th>
        </tr>
      </thead>
      <tbody>

        @foreach ($productos as $producto)
          <tr
            class="border-b border-gray-200 bg-white hover:bg-gray-300/15 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
            <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium uppercase text-black dark:text-white">
              <a href="{{ route('productos.show', $producto) }}"
                class="hover:font-bold hover:text-yellow-500 hover:underline">
                {{ $producto->nombre }}
              </a>
            </th>
            <td class="px-6 py-4">
              {{ $producto->marca->nombre ?? '-' }}
            </td>
            <td class="px-6 py-4">
              {{ $producto->categoria->nombre ?? '-' }}
            </td>
            <td class="px-6 py-4">
              ${{ number_format($producto->precio, 0, ',', '.') }}
            </td>
            <td class="px-6 py-4">
              {{ $producto->sku }}
            </td>
            <td class="px-6 py-4">
              {{ $producto->existencia }}
            </td>
            <td class="px-6 py-4 text-right">
              <div class="flex flex-row gap-4">
                <a href="{{ route('productos.edit', $producto) }}" class="btn-primary-grid flex items-center gap-1">
                  <flux:icon name="pencil" class="h-4 w-4" />
                  Editar
                </a>
                {{-- <a href="{{ route('productos.show', $producto) }}"
                  class="rounded-md bg-yellow-400 px-2 py-1 font-medium text-black shadow-md hover:bg-yellow-500 dark:text-blue-500">Ver
                  Detalles</a> --}}
                <button class="btn-secundary-grid flex items-center gap-1">
                  <flux:icon name="trash" class="h-4 w-4" />
                  Eliminar
                </button>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <x-propios.floating-add-button url="{{ route('productos.create') }}" />

</x-layouts.app>
