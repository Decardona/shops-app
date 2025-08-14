<x-layouts.app>

  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('user.index')" :current="true" class="text-xl">
      {{ __('Usuarios') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <form method="GET" action="{{ route('user.index') }}">
    <div class="my-6 flex w-full flex-row gap-4 md:w-1/3">
      <div
        class="relative flex w-full flex-row items-center rounded-md border border-gray-300 bg-white p-2 shadow-sm focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500">
        <flux:icon name="magnifying-glass" class="absolute left-3 top-3 h-5 w-5 text-gray-500" />
        <input type="text" name="q" placeholder="Buscar usuario..." class="w-full pl-8 focus:outline-none"
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
            Apellido
          </th>
          <th scope="col" class="px-6 py-3">
            Email
          </th>
          <th scope="col" class="px-6 py-3">
            Rol
          </th>
          <th scope="col" class="px-6 py-3">
            Fecha de Alta
          </th>
          <th scope="col" class="px-6 py-3">
            Acciones
          </th>
        </tr>
      </thead>
      <tbody>

        @foreach ($usuarios as $usuario)
          <tr
            class="border-b border-gray-200 bg-white hover:bg-gray-300/15 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
            <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium uppercase text-black dark:text-white">
              {{ $usuario->name }}
            </th>
            <td class="px-6 py-4">
              {!! $usuario->apellido ?? '<i>No especificado</i>' !!}
            </td>
            <td class="px-6 py-4">
              {{ $usuario->email }}
            </td>
            <td class="px-6 py-4">
              @switch($usuario->rol)
                @case('user')
                  Usuario estándar
                @break

                @case('admin')
                  Administrador
                @break

                @case('guest')
                  Cliente visitante
                @break

                @default
                  {{ $usuario->rol }}
              @endswitch
            </td>
            <td class="px-6 py-4">
              {{ $usuario->created_at->format('d/m/Y') }}
            </td>
            <td class="px-6 py-4 text-right">
              <div class="flex flex-row gap-4">
                <a href="{{ route('user.edit', $usuario) }}" class="btn-primary-grid flex items-center gap-1">
                  <flux:icon name="pencil" class="h-4 w-4" />
                  Editar
                </a>
                {{-- <a href="{{ route('productos.show', $producto) }}"
                  class="rounded-md bg-yellow-400 px-2 py-1 font-medium text-black shadow-md hover:bg-yellow-500 dark:text-blue-500">Ver
                  Detalles</a> --}}
                <form action="{{ route('user.destroy', $usuario) }}" method="POST" class="delete-form">
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
    {{ $usuarios->links('vendor.pagination.tailwind') }}
  </div>
  <x-propios.floating-add-button url="{{ route('user.create') }}" />

  {{-- Los formularios con clase 'delete-form' se configuran automáticamente --}}

</x-layouts.app>
