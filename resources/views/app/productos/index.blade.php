<x-layouts.app>
    <div class="container mx-auto p-6">
        <h1 class="mb-8 text-3xl font-bold text-gray-800">Productos</h1>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
            {{-- Recorremos los productos y los mostramos en tarjetas --}}
            @foreach ($productos as $producto)
                <div class="md:h-68 group relative flex h-auto flex-col overflow-hidden rounded-lg bg-white shadow-md hover:shadow-lg">
                    <!-- Header de la tarjeta -->
                    <div class="flex flex-shrink-0 justify-between gap-2 border-b bg-gray-100 p-4">
                        <div class="flex flex-col">
                            <span class="truncate text-wrap text-lg font-semibold capitalize text-gray-800">{{ $producto->nombre }}</span>
                            <span class="mt-1 text-sm capitalize text-gray-500">{{ $producto->marca->nombre ?? 'Sin marca' }}</span>
                        </div>
                        <div>
                            @if ($producto->categoria && $producto->categoria->imagen)
                                <img src="{{ asset($producto->categoria->imagen) }}" alt="Imagen categoría"
                                    class="h-13 w-13 rounded-full border-2 border-gray-200 object-cover shadow-md transition-transform duration-300 group-hover:scale-110" />
                            @else
                                <div class="h-13 w-13 flex items-center justify-center rounded-full bg-gray-200">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Contenido de la tarjeta -->
                    <div class="flex flex-1 flex-col space-y-3 p-4">
                        <p class="text-sm text-gray-600"
                            style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ Str::limit($producto->descripcion, 80) }}</p>

                        <div class="mt-auto flex items-center">
                            <span class="mr-2 inline-block h-2 w-2 rounded-full bg-black"></span>
                            <span class="text-xs font-medium text-black">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</span>
                        </div>


                    </div>

                    <!-- Footer de la tarjeta -->
                    <div class="flex-shrink-0 border-t bg-gray-50 px-4 py-3">
                        <button
                            class="w-full cursor-pointer rounded bg-yellow-500 px-4 py-2 text-sm font-medium text-black transition-colors duration-200 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">
                            Ver detalles
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
