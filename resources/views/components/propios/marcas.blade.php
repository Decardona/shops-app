<div>
  <label for="{{ $name }}" class="mb-1 block">{{ $label }}</label>
  <select id="{{ $name }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'w-full px-3 py-2 border rounded']) }}>
    <option value="">Seleccione...</option>
    @foreach ($marcas as $marca)
      <option value="{{ $marca->id }}" @selected($selected == $marca->id)>{{ $marca->nombre }}</option>
    @endforeach
  </select>
</div>
