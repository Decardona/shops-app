@props([
    'name' => 'rol',
    'selected' => null,
    'label' => 'Rol',
])

<div>
  <label for="{{ $name }}" class="mb-1 block">{{ $label }}</label>
  <select id="{{ $name }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'w-full px-3 py-2 border rounded']) }}>
    <option value="">Seleccione...</option>
    <option value="admin" @selected($selected == 'admin')>Administrador</option>
    <option value="user" @selected($selected == 'user')>Usuario Estándar</option>
    <option value="guest" @selected($selected == 'guest')>Cliente Visitante</option>
  </select>
</div>
