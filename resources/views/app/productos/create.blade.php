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
    {{-- <p class="mt-2 text-gray-600">{{ __('Ingresa los detalles del nuevo producto a continuación.') }}</p> --}}
  </div>

  <div class="mt-4 rounded-md p-4 shadow-md md:p-10">
    <form action="{{ route('productos.store') }}" method="POST" class="grid grid-cols-1 space-y-4 md:grid-cols-2 md:gap-3"
      enctype="multipart/form-data">
      @csrf



      <div class="grid grid-cols-1 gap-4 md:col-span-2 md:grid-cols-2 md:gap-6">
        <div class="relative rounded-md">
          <div class="absolute left-3 top-3">
            <label class="cursor-pointer">
              <flux:tooltip title="Subir Imagen">
                <div class="flex flex-row items-center justify-center gap-1">
                  <flux:icon name="arrow-up-tray"
                    class="h-5 w-5 rounded-md bg-gray-100 p-2 font-bold shadow-md transition-colors hover:bg-black hover:text-white md:h-10 md:w-10">
                    {{ __('Subir Imagen') }}
                  </flux:icon>
                </div>
                <input type="file" name="imagen_file" id="input-imagen" accept="image/*" class="hidden" />
              </flux:tooltip>
            </label>
          </div>
          <img id="preview-imagen" src="{{ old('imagen_file', asset('noimageproduct.png')) }}" alt="Imagen del producto"
            class="aspect-video w-full object-cover object-center" />
        </div>
        <div class="mt-4 flex flex-col gap-3 md:mt-0">
          <div class="flex justify-end md:col-span-2">
            <flux:radio.group name="activo" variant="segmented">
              <flux:radio label="Activo" icon="check" value="1" :checked="old('activo') == 1" />
              <flux:radio label="Inactivo" icon="x-mark" value="0" :checked="old('activo') == 0" />
            </flux:radio.group>
          </div>
          <x-propios.categorias :selected="old('categoria_id') ?? null" name="categoria_id" />

          <x-propios.marcas :selected="old('marca_id') ?? ''" name="marca_id" />

          <flux:input name="nombre" label="{{ __('Nombre del Producto') }}" :value="old('nombre')" type="text"
            required />

          <flux:input name="sku" label="{{ __('SKU') }}" :value="old('sku')" type="text" required />
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <flux:input name="precio" label="{{ __('Precio') }}" type="number" step="0.01" :value="old('precio')"
              required />
            <flux:input name="existencia" label="{{ __('Existencia') }}" type="number" :value="old('existencia')"
              required />
          </div>

        </div>
      </div>
      <div class="md:col-span-2">
        <flux:textarea name="descripcion" label="{{ __('Descripción') }}" placeholder="Escribe una descripción"
          rows="3" resize="none" required>
          {{ old('descripcion') }}
        </flux:textarea>
      </div>

      <div class="mt-4 flex justify-end md:col-span-2">
        <button type="submit" class="btn-primary">{{ __('Crear Producto') }}</button>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const input = document.getElementById('input-imagen');
      const preview = document.getElementById('preview-imagen');
      if (input && preview) {
        input.addEventListener('change', function(e) {
          const file = e.target.files[0];
          if (file) {
            preview.src = URL.createObjectURL(file);
          }
        });
      }
    });
  </script>
</x-layouts.app>
