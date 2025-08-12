@props(['type' => 'success', 'title', 'message'])

<script>
  (function() {
    function showAlert() {
      if (typeof window.Swal !== 'undefined') {
        window.Swal.fire({
          title: '{{ $title }}',
          text: '{{ $message }}',
          icon: '{{ $type }}',
          confirmButtonText: 'Aceptar',
          timer: {{ $type === 'success' ? '3000' : 'false' }},
          timerProgressBar: {{ $type === 'success' ? 'true' : 'false' }},
          showCloseButton: true
        });
      } else {
        // Fallback: intentar nuevamente después de un breve delay
        setTimeout(showAlert, 100);
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', showAlert);
    } else {
      showAlert();
    }
  })();
</script>
