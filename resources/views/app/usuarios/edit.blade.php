<x-layouts.app>

  <flux:breadcrumbs>
    <flux:breadcrumbs.item :href="route('user.index')" :current="true" class="text-xl">
      {{ __('Usuarios') }}
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item :current="true" class="text-xl">
      {{ __('Edición') }}
    </flux:breadcrumbs.item>
  </flux:breadcrumbs>

  <div class="mt-6">
    <h1 class="text-2xl font-bold">{{ __('Editar Usuario') }}</h1>
    {{-- <p class="mt-2 text-gray-600">{{ __('Ingresa los detalles del nuevo producto a continuación.') }}</p> --}}
  </div>

  <div class="mt-4 rounded-md p-4 shadow-md md:p-10">
    <form action="{{ route('user.update', $usuario) }}" method="POST"
      class="grid grid-cols-1 space-y-4 md:grid-cols-2 md:gap-3">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 gap-4 md:col-span-2 md:grid-cols-2 md:gap-6">


        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
          <flux:input name="name" label="{{ __('Nombre') }}" :value="old('name', $usuario->name)" type="text"
            required />
          <flux:input name="apellido" label="{{ __('Apellido') }}" :value="old('apellido', $usuario->apellido)"
            type="text" required />
        </div>


        <flux:input name="email" label="{{ __('Email') }}" :value="old('email', $usuario->email)" type="email"
          required />
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <flux:input name="password" label="{{ __('Contraseña') }}" type="password" />
          <flux:input name="password_confirmation" label="{{ __('Confirmar Contraseña') }}" type="password" />
        </div>

        <x-propios.user_roles name="rol" :selected="$usuario->rol" />


      </div>

      <div class="mt-4 flex justify-end gap-3 md:col-span-2">
        <a href="{{ route('user.index') }}" class="btn-secundary">Cancelar</a>
        <button type="submit" class="btn-primary">{{ __('Actualizar Usuario') }}</button>
      </div>
    </form>
  </div>

</x-layouts.app>
