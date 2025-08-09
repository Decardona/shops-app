<x-layouts.app>

  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('productos.index')" :current="true" class="text-xl">
      {{ __('Productos') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true" class="text-xl">
      {{ __('Nuevo') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="mt-6">
    <h1 class="text-2xl font-bold">{{ __('Crear Producto') }}</h1>
    <p class="mt-2 text-gray-600">{{ __('Ingresa los detalles del nuevo producto a continuación.') }}</p>
  </div>

  <div class="mt-4 rounded-md p-7 shadow-md">
    <form action="{{ route('productos.store') }}" method="POST"
      class="grid grid-cols-1 space-y-4 md:grid-cols-2 md:gap-4">
      @csrf

      <x-propios.categorias :selected="$categoriaSeleccionada ?? null" name="categoria_id" />

      <x-propios.marcas :selected="$marcaSeleccionada ?? ''" name="marca_id" />

      <flux:input name="nombre" label="{{ __('Nombre del Producto') }}" :value="old('nombre')" type="text"
        required />

      <flux:input name="sku" label="{{ __('SKU') }}" :value="old('sku')" type="text" required />

      <div class="md:col-span-2">
        <flux:textarea name="descripcion" label="{{ __('Descripción') }}" placeholder="Escribe una descripción"
          rows="3" resize="none" :value="old('descripcion')" required />
      </div>

      <flux:input name="precio" label="{{ __('Precio') }}" type="number" step="0.01" :value="old('precio')"
        required />
      <flux:input name="existencia" label="{{ __('Existencia') }}" type="number" :value="old('existencia')" required />

      <div class="mt-4 flex justify-end md:col-span-2">
        <button type="submit" class="btn-primary">{{ __('Crear Producto') }}</button>
      </div>
    </form>
  </div>

</x-layouts.app>
