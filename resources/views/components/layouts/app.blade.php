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

  <!-- Funciones globales de SweetAlert -->
  <script>
    // Función global para configurar confirmaciones de eliminación
    window.setupDeleteConfirmation = function(selector = '.delete-form') {
      function waitForSwal(callback, attempts = 0) {
        if (attempts > 30) {
          callback();
          return;
        }
        if (typeof window.Swal !== 'undefined') {
          callback();
        } else {
          setTimeout(() => waitForSwal(callback, attempts + 1), 100);
        }
      }

      function configure() {
        document.querySelectorAll(selector).forEach(form => {
          // Evitar múltiples listeners
          if (form.hasAttribute('data-delete-configured')) return;
          form.setAttribute('data-delete-configured', 'true');

          form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Buscar el nombre del elemento
            const nameElement = this.closest('tr')?.querySelector('th a, td a, [data-item-name]') ||
              this.querySelector('[data-item-name]');
            const itemName = nameElement ?
              (nameElement.textContent?.trim() || nameElement.dataset.itemName) :
              'este elemento';

            if (typeof window.Swal !== 'undefined') {
              window.Swal.fire({
                title: 'Confirmar eliminación',
                html: `¿Deseas eliminar <strong>${itemName}</strong>?`,
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f0b100",
                cancelButtonColor: "#000",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sí, eliminar",
                reverseButtons: true,
                focusCancel: true,
                allowOutsideClick: false,
                allowEscapeKey: true,
                customClass: {
                  confirmButton: 'cursor-pointer bg-yellow-500 hover:bg-yellow-500/50 text-black font-medium py-2 px-4 rounded-md transition-colors duration-200 mr-3',
                  cancelButton: 'cursor-pointer bg-black hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 ml-3',
                  actions: 'gap-3 flex justify-center'
                },
                buttonsStyling: false
              }).then((result) => {
                if (result.isConfirmed) {
                  const submitBtn = this.querySelector('button[type="submit"]');
                  if (submitBtn) {
                    submitBtn.disabled = true;
                    const originalHTML = submitBtn.innerHTML;
                    submitBtn.innerHTML =
                      '<span class="inline-flex items-center gap-1"><svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Eliminando...</span>';
                  }
                  this.submit();
                }
              });
            } else {
              if (confirm(
                  `¿Estás seguro de que deseas eliminar "${itemName}"? Esta acción no se puede deshacer.`)) {
                this.submit();
              }
            }
          });
        });
      }

      waitForSwal(configure);
    };

    // Auto-configurar al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
      setTimeout(() => window.setupDeleteConfirmation(), 300);
    });

    // Re-configurar para Livewire
    document.addEventListener('livewire:navigated', function() {
      setTimeout(() => window.setupDeleteConfirmation(), 100);
    });
  </script>

  @stack('js')

</x-layouts.app.sidebar>
