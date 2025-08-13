<x-layouts.app>

  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('terceros.index')">
      {{ __('Terceros') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true">
      {{ __('Editar Tercero') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  
  <div>
    <form action="{{ route('terceros.update', $tercero) }}" method="POST" class="max-w-2xl mx-auto mt-8">
      @csrf
      @method('PUT')<div class="mb-4">
        <label for="tipo_documento" class="block text-sm font-medium text-gray-700">Tipo de documento</label>
        <input type="text" name="tipo_documento" id="tipo_documento" class="input" 
          value="{{ old('tipo_documento', $tercero->tipo_documento) }}" required>
        @error('tipo_documento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="mb-4">
        <label for="documento" class="block text-sm font-medium text-gray-700">Documento</label>
        <input type="text" name="documento" id="documento" class="input" 
          value="{{ old('documento', $tercero->documento) }}" required>
        @error('documento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="mb-4 flex gap-4">
        <div>
          <label for="escliente" class="block text-sm font-medium text-gray-700">¿Es cliente?</label>
          <input type="checkbox" name="escliente" id="escliente" value="1" 
            {{ old('escliente', $tercero->escliente) ? 'checked' : '' }}>
        </div>
        <div>
          <label for="esproveedor" class="block text-sm font-medium text-gray-700">¿Es proveedor?</label>
          <input type="checkbox" name="esproveedor" id="esproveedor" value="1" 
            {{ old('esproveedor', $tercero->esproveedor) ? 'checked' : '' }}>
        </div>
      </div>

      <div class="mb-4">
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="input" 
          value="{{ old('nombre', $tercero->nombre) }}" required>
        @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="mb-4">
        <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
        <input type="text" name="apellido" id="apellido" class="input" 
          value="{{ old('apellido', $tercero->apellido) }}">
        @error('apellido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="mb-4">
        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
        <input type="text" name="telefono" id="telefono" class="input" 
          value="{{ old('telefono', $tercero->telefono) }}">
        @error('telefono') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" class="input" 
          value="{{ old('email', $tercero->email) }}">
        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="mb-4">
        <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
        <input type="text" name="direccion" id="direccion" class="input" 
          value="{{ old('direccion', $tercero->direccion) }}">
        @error('direccion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
      </div>

      <div class="flex justify-end">
        <a href="{{ route('terceros.index') }}" class="btn-secundary me-2">Cancelar</a>
        <button type="submit" class="btn-primary">Actualizar tercero</button>
      </div>
    </form>
  </div>
</x-layouts.app>