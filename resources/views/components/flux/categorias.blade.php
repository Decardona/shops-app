@props([
    'name' => 'id_categoria',
    'selected' => null,
    'label' => 'Categoría',
])

<div>
    <label for="{{ $name }}" class="mb-1 block">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'flux-select w-full px-3 py-2 border rounded']) }}>
        <option value="">Seleccione...</option>
        <option value="CC" @selected($selected == 'CC')>Cédula de Ciudadanía</option>
        <option value="CE" @selected($selected == 'CE')>Cédula de Extranjería</option>
        <option value="NIT" @selected($selected == 'NIT')>NIT</option>
    </select>
</div>
