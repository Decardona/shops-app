<x-layouts.app>

  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('terceros.index')" :current="true" class="text-xl">
      {{ __('Terceros') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <form method="GET" action="{{ route('terceros.index') }}">
    <div class="my-6 flex w-full flex-row gap-4 md:w-1/3">
      <div
        class="relative flex w-full flex-row items-center rounded-md border border-gray-300 bg-white p-2 shadow-sm focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500">
        <flux:icon name="magnifying-glass" class="absolute left-3 top-3 h-5 w-5 text-gray-500" />
        <input type="text" name="q" placeholder="Buscar tercero..." class="w-full pl-8 focus:outline-none"
          value="{{ request('q') }}" />
      </div>
      <button type="submit" class="btn-secundary">Buscar</button>
    </div>
  </form>

  <div class="relative mt-6 overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
      <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="min-w-1/6 p-2">Documento</th>
          <th scope="col" class="min-w-1/6 p-2">Nombre</th>
          <th scope="col" class="min-w-1/6 p-2">Apellido</th>
          <th scope="col" class="min-w-1/6 p-2">tipo tercero</th>
          <th scope="col" class="min-w-1/6 p-2">Telefono </th>
          <th scope="col" class="min-w-1/6 p-2">Direccion</th>
          <th scope="col" class="min-w-1/6 p-2">Correo</th>
          <th scope="col" class="min-w-1/6 p-2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($terceros as $tercero)
          <tr
            class="border-b border-gray-200 bg-white hover:bg-gray-300/15 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
            <td class="min-w-1/6 p-2 font-medium uppercase text-black dark:text-white">
              <a href="#" class="hover:text-yellow-500">
                <div class="flex flex-row gap-2">
                  <span class="text-gray-500">
                    {{ $tercero->tipo_documento }}:
                  </span>{{ $tercero->documento }}
                </div>
              </a>
            </td>
            <td class="min-w-1/6 p-2">{{ $tercero->nombre }}</td>
            <td class="min-w-1/6 p-2">{{ $tercero->apellido }}</td>
            <td class="min-w-1/6 p-2">
              @if ($tercero->escliente && $tercero->esproveedor)
                Cliente y Proveedor
              @elseif ($tercero->escliente)
                Cliente
              @elseif ($tercero->esproveedor)
                Proveedor
              @else
                Ninguno
              @endif
            <td class="min-w-1/6 p-2">{{ $tercero->telefono }}</td>
            <td class="min-w-1/6 p-2">{{ $tercero->direccion }}</td>
            <td class="min-w-1/6 p-2">{{ $tercero->email }}</td>

            <td class="min-w-1/6 p-2 text-right">
              <div class="flex flex-row gap-4">
                <a href="{{ route('terceros.edit', $tercero) }}" class="btn-primary-grid flex items-center gap-1">
                  <flux:icon name="pencil" class="h-4 w-4" />
                  Editar
                </a>
                <form action="#" method="POST" class="delete-form">
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
    {{ $terceros->links('vendor.pagination.tailwind') }}
  </div>
  <x-propios.floating-add-button url="{{ route('terceros.create') }}" />

</x-layouts.app>
