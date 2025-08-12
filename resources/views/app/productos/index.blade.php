<x-layouts.app>

  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('productos.index')" :current="true" class="text-xl">
      {{ __('Productos') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <form method="GET" action="{{ route('productos.index') }}">
    <div class="my-6 flex w-full flex-row gap-4 md:w-1/3">
      <div
        class="relative flex w-full flex-row items-center rounded-md border border-gray-300 bg-white p-2 shadow-sm focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500">
        <flux:icon name="magnifying-glass" class="absolute left-3 top-3 h-5 w-5 text-gray-500" />
        <input type="text" name="q" placeholder="Buscar producto..." class="w-full pl-8 focus:outline-none"
          value="{{ request('q') }}" />
      </div>
      <button type="submit" class="btn-secundary">Buscar</button>
    </div>
  </form>

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
                <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="delete-form">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-secundary-grid flex items-center gap-1">
                    <flux:icon name="trash" class="h-4 w-4" />
                    Eliminar
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="mt-3">
    {{ $productos->links('vendor.pagination.tailwind') }}
  </div>
  <x-propios.floating-add-button url="{{ route('productos.create') }}" />

  @push('js')
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
          form.addEventListener('submit', (event) => {
            event.preventDefault();
            Swal.fire({
              title: `¿Deseas eliminar ${form.closest('tr').querySelector('th a').textContent.trim()}?`,
              text: "No podrás revertir esto.",
              icon: "question",
              showCancelButton: true,
              confirmButtonColor: "#f0b100",
              cancelButtonColor: "#000",
              cancelButtonText: "Cancelar",
              confirmButtonText: "Sí, eliminarlo"
            }).then((result) => {
              if (result.isConfirmed) {
                form.submit();
              }
            });
          });
        });
      });
    </script>
  @endpush

</x-layouts.app>
