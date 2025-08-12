# Sistema Centralizado de SweetAlert - FUNCIONANDO ✅

## Descripción

Sistema de SweetAlert completamente centralizado en el layout principal que funciona automáticamente para confirmaciones de eliminación.

## ✅ Uso Automático (Recomendado)

### Formularios de Eliminación

Simplemente agrega la clase `delete-form` a cualquier formulario:

```blade
<form action="{{ route('productos.destroy', $producto) }}" method="POST" class="delete-form">
  @csrf
  @method('DELETE')
  <button type="submit" class="btn-danger">
    <flux:icon name="trash" class="h-4 w-4" />
    Eliminar
  </button>
</form>
```

**Características automáticas:**

-   ✅ Detecta automáticamente el nombre del elemento desde enlaces en la fila de la tabla
-   ✅ Previene múltiples envíos con indicador de carga
-   ✅ Fallback automático a `confirm()` nativo si SweetAlert falla
-   ✅ Compatible con Livewire y navegación dinámica
-   ✅ Cero JavaScript adicional requerido en las vistas

## 🎯 Detección Automática del Nombre

El sistema busca automáticamente el nombre del elemento en este orden:

1. `th a` o `td a` en la fila de la tabla
2. `[data-item-name]` en cualquier elemento
3. Fallback a "este elemento"

### Ejemplo con data-item-name personalizado:

```blade
<form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="delete-form">
  @csrf
  @method('DELETE')
  <span data-item-name="{{ $categoria->nombre }}"></span>
  <button type="submit">Eliminar</button>
</form>
```

## 🔧 Configuración Manual (Casos Especiales)

### Re-configurar después de cargar contenido dinámico:

```javascript
// Después de cargar contenido con AJAX
window.setupDeleteConfirmation(); // Re-configura todos los .delete-form

// O para un selector específico
window.setupDeleteConfirmation('.mi-formulario-especial');
```

### Usar las funciones globales de SweetAlert:

```javascript
// Alerta de éxito
window.showSuccess('¡Éxito!', 'Producto guardado correctamente');

// Alerta de error
window.showError('Error', 'No se pudo guardar');

// Confirmación personalizada
window.showConfirm('¿Continuar?', '¿Deseas guardar los cambios?').then((result) => {
    if (result.isConfirmed) {
        // Usuario confirmó
    }
});
```

## 📝 Ejemplos de Implementación

### 1. Lista de Productos (Actual)

```blade
<!-- resources/views/app/productos/index.blade.php -->
<x-layouts.app>
  <table>
    @foreach($productos as $producto)
      <tr>
        <th><a href="#">{{ $producto->nombre }}</a></th>
        <td>
          <!-- ✅ Funciona automáticamente -->
          <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="delete-form">
            @csrf @method('DELETE')
            <button type="submit">Eliminar</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
</x-layouts.app>
```

### 2. Para cualquier otra entidad

```blade
<!-- resources/views/app/categorias/index.blade.php -->
<x-layouts.app>
  <table>
    @foreach($categorias as $categoria)
      <tr>
        <th><a href="#">{{ $categoria->nombre }}</a></th>
        <td>
          <!-- ✅ Funciona automáticamente -->
          <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="delete-form">
            @csrf @method('DELETE')
            <button type="submit">Eliminar Categoría</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
</x-layouts.app>
```

### 3. Con nombre personalizado

```blade
<form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="delete-form">
  @csrf @method('DELETE')
  <input type="hidden" data-item-name="{{ $usuario->name }} ({{ $usuario->email }})">
  <button type="submit">Eliminar Usuario</button>
</form>
```

## 🚀 Ventajas del Sistema Final

✅ **Ultra Simple**: Solo agrega `class="delete-form"`  
✅ **Cero JavaScript**: No necesitas escribir JavaScript en las vistas  
✅ **Auto-detecta nombres**: Encuentra automáticamente qué eliminar  
✅ **Robusto**: Maneja errores y tiene fallbacks  
✅ **Reutilizable**: Funciona en cualquier vista  
✅ **Mantenible**: Un solo lugar para cambios  
✅ **Compatible**: Funciona con Livewire y AJAX

## 🔄 Migración desde Implementaciones Anteriores

Simplemente:

1. ✅ Remueve todo el JavaScript personalizado de tus vistas
2. ✅ Asegúrate que el formulario tenga `class="delete-form"`
3. ✅ ¡Listo! El sistema se encarga del resto

## ⚡ Troubleshooting

**Si no funciona:**

1. Verifica que el formulario tenga `class="delete-form"`
2. Asegúrate que hay un enlace (`<a>`) en la fila de la tabla
3. O agrega `data-item-name="Nombre del elemento"` al formulario
4. Abre F12 y revisa si hay errores en la consola

**El sistema siempre tiene un fallback a `confirm()` nativo si SweetAlert falla.**
