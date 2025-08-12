<x-layouts.app>
  <div class="mx-auto p-6">
    <h1 class="mb-8 text-3xl font-bold text-gray-800">Productos</h1>
    <form method="GET" action="{{ route('vitrina') }}">
      <div class="mb-6 flex w-full flex-row gap-4 md:w-1/3">
        <div
          class="relative flex w-full flex-row items-center rounded-md border border-gray-300 bg-white p-2 shadow-sm focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500">
          <flux:icon name="magnifying-glass" class="absolute left-3 top-3 h-5 w-5 text-gray-500" />
          <input type="text" name="q" placeholder="Buscar producto..." class="w-full pl-8 focus:outline-none"
            value="{{ request('q') }}" />
        </div>
        <button type="submit" class="btn-secundary">Buscar</button>
      </div>
    </form>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
      {{-- Recorremos los productos y los mostramos en tarjetas --}}
      @foreach ($productos as $producto)
        <div
          class="md:h-68 group relative flex h-auto flex-col overflow-hidden rounded-lg bg-white shadow-md hover:shadow-lg">
          <!-- Header de la tarjeta -->
          <div class="flex flex-shrink-0 justify-between gap-2 border-b bg-gray-100 p-4">
            <div class="flex flex-col">
              <span
                class="truncate text-wrap text-lg font-semibold capitalize text-gray-800">{{ $producto->nombre }}</span>
              <span class="mt-1 text-sm capitalize text-gray-500">{{ $producto->marca->nombre ?? 'Sin marca' }}</span>
            </div>
            <div>
              @if ($producto->categoria && $producto->categoria->imagen)
                <img
                  src="{{ $producto->imagen ? asset('storage/products/' . $producto->imagen) : asset($producto->categoria->imagen) }}"
                  alt="Imagen categoría"
                  class="h-13 w-13 rounded-full border-2 border-gray-200 object-cover shadow-md transition-transform duration-300 group-hover:scale-110" />
              @else
                <img src="{{ asset('noimageproduct.png') }}" alt="Imagen categoría"
                  class="h-13 w-13 rounded-full border-2 border-gray-200 object-cover shadow-md transition-transform duration-300 group-hover:scale-110" />
              @endif
            </div>
          </div>

          <!-- Contenido de la tarjeta -->
          <div class="flex flex-1 flex-col space-y-3 p-4">
            <p class="text-sm text-gray-600"
              style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
              {{ Str::limit($producto->descripcion, 80) }}</p>

            <div class="mt-auto flex flex-row items-center md:justify-between">
              <div class="hidden md:block">
                <span class="mr-2 inline-block h-2 w-2 rounded-full bg-black"></span>
                <span
                  class="text-xs font-medium text-black">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</span>
              </div>
              <span class="font-bold text-black">${{ number_format($producto->precio, 2, '.', ',') }}</span>
            </div>
          </div>

          <!-- Footer de la tarjeta -->
          <div class="flex-shrink-0 border-t bg-gray-50 px-4 py-3">
            <button class="btn-primary w-full" onclick="location.href='{{ route('productos.show', $producto) }}'">
              Ver detalles
            </button>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mt-3">
      {{ $productos->links('vendor.pagination.tailwind') }}
    </div>
  </div>
</x-layouts.app>
