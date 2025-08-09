<x-layouts.app>

  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('productos.index')" :current="true" class="text-xl">
      {{ __('Productos') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true" class="text-xl">
      {{ __('Edición') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="mt-6">
    <h1 class="text-2xl font-bold">{{ __('Editar Producto') }}</h1>
    <p class="mt-2 text-gray-600">{{ __('Ingresa los detalles del producto a continuación.') }}</p>
  </div>

  <div class="mt-4 rounded-md p-7 shadow-md">
    <form action="{{ route('productos.update', $producto) }}" method="POST"
      class="grid grid-cols-1 space-y-4 md:grid-cols-2 md:gap-4">
      @csrf
      @method('PUT')

      <div class="flex justify-end md:col-span-2">
        <flux:radio.group name="activo" variant="segmented">
          <flux:radio label="Activo" icon="check" value="1" :checked="old('activo', $producto->activo) == 1" />
          <flux:radio label="Inactivo" icon="x-mark" value="0" :checked="old('activo', $producto->activo) == 0" />
        </flux:radio.group>
      </div>


      <x-propios.categorias :selected="$producto->categoria_id" name="categoria_id" />

      <x-propios.marcas :selected="$producto->marca_id" name="marca_id" />

      <flux:input name="nombre" label="{{ __('Nombre del Producto') }}" :value="old('nombre', $producto->nombre)"
        type="text" required />

      <flux:input name="sku" label="{{ __('SKU') }}" :value="old('sku', $producto->sku)" type="text"
        required />

      <div class="md:col-span-2">
        <flux:textarea name="descripcion" label="{{ __('Descripción') }}" placeholder="Escribe una descripción"
          rows="3" resize="none" required>{{ old('descripcion', $producto->descripcion) }}</flux:textarea>
      </div>

      <flux:input name="precio" label="{{ __('Precio') }}" type="number" step="0.01"
        :value="old('precio', $producto->precio)" required />
      <flux:input name="existencia" label="{{ __('Existencia') }}" type="number"
        :value="old('existencia', $producto->existencia)" required />



      <div class="mt-4 flex justify-end md:col-span-2">
        <button type="submit" class="btn-primary">{{ __('Actualizar Producto') }}</button>
      </div>
    </form>
  </div>

</x-layouts.app>
