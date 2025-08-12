<x-layouts.app>

  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route(auth()->user()->rol === 'guest' ? 'vitrina' : 'productos.index')"
      :current="true" class="text-xl">
      {{ __('Productos') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true" class="text-xl">
      {{ __('Detalles') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="mt-6">
    <h1 class="text-2xl font-bold">{{ __('Detalles del Producto') }}</h1>
  </div>
  {{-- <div>
    {{ dd(auth()->user()->rol) }}
  </div> --}}

  <div class="mt-4 rounded-md p-4 shadow-md md:p-10">
    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-6">
      <img src="{{ $producto->imagen ? asset('storage/products/' . $producto->imagen) : asset('noimageproduct.png') }}"
        alt="{{ $producto->nombre }}" class="aspect-video w-full rounded-md object-cover object-center" />
      <div class="mt-4 md:mt-0">
        <span class="text-2xl font-bold text-yellow-500 md:ml-2">{{ $producto->nombre }}</span>
        <p class="text-md text-gray-600 md:px-2">{{ $producto->descripcion }}</p>

        <div class="mt-4 flex flex-col">
          <div class="flex flex-row justify-between rounded-md bg-gray-100 p-2 md:justify-start">
            <span class="font-semibold md:w-1/4">{{ __('Precio') }}:</span>
            <span class="font-semibold">${{ number_format($producto->precio, 2, '.', ',') }}</span>
          </div>
          <div class="flex flex-row justify-between p-2 md:justify-start">
            <span class="font-semibold md:w-1/4">{{ __('SKU') }}:</span>
            <span>{{ $producto->sku }}</span>
          </div>
          <div class="flex flex-row justify-between rounded-md bg-gray-100 p-2 md:justify-start">
            <span class="font-semibold md:w-1/4">{{ __('Categoría') }}:</span>
            <span>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</span>
          </div>
          <div class="flex flex-row justify-between p-2 md:justify-start">
            <span class="font-semibold md:w-1/4">{{ __('Existencia') }}:</span>
            <span>{{ $producto->existencia }}</span>
          </div>
          <div class="flex flex-row justify-between rounded-md bg-gray-100 p-2 md:justify-start">
            <span class="font-semibold md:w-1/4">{{ __('Marca') }}:</span>
            <span>{{ $producto->marca->nombre ?? 'Sin marca' }}</span>
          </div>
          @if (auth()->user()->rol !== 'guest')
            <div class="flex flex-row justify-between p-2 md:justify-start">
              <span class="font-semibold md:w-1/4">{{ __('Costo Promedio') }}:</span>
              <span>${{ number_format($producto->costo_promedio, 2, '.', ',') }}</span>
            </div>
          @endif

        </div>
      </div>
    </div>

  </div>


</x-layouts.app>
