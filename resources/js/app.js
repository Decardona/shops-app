import Swal from 'sweetalert2';

// Hacer SweetAlert2 disponible globalmente
window.Swal = Swal;

// Configuración por defecto
Swal.mixin({
    customClass: {
        confirmButton: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2',
        cancelButton: 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded',
    },
    buttonsStyling: false,
});

console.log('SweetAlert2 cargado correctamente');
