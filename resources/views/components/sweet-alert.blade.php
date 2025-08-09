@props(['type' => 'success', 'title', 'message'])

<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      title: '{{ $title }}',
      text: '{{ $message }}',
      icon: '{{ $type }}',
      confirmButtonText: 'Aceptar'
    });
  });
</script>
