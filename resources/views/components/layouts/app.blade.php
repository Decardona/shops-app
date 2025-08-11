<x-layouts.app.sidebar :title="$title ?? null">
  <flux:main>
    {{ $slot }}
  </flux:main>

  @if (session('success'))
    <x-sweet-alert type="success" title="Excelente" message="{{ session('success') }}" />
  @endif

  @if (session('error'))
    <x-sweet-alert type="error" title="¡Uy! Algo salió mal" message="{{ session('error') }}" />
  @endif

  @stack('js')

</x-layouts.app.sidebar>
