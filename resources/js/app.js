import Swal from 'sweetalert2';

// Hacer SweetAlert2 disponible globalmente
window.Swal = Swal;

// Configuración por defecto
const defaultSwalConfig = Swal.mixin({
    customClass: {
        confirmButton:
            'cursor-pointer bg-yellow-500 hover:bg-yellow-400 text-black font-medium py-2 px-4 rounded-md transition-colors duration-200 mr-3',
        cancelButton:
            'cursor-pointer bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 ml-3',
        popup: 'rounded-lg shadow-xl',
        title: 'text-gray-800 font-semibold',
        content: 'text-gray-600',
        actions: 'gap-4 flex justify-center items-center',
    },
    buttonsStyling: false,
    allowOutsideClick: false,
    allowEscapeKey: true,
    showCloseButton: false,
    timer: false,
    timerProgressBar: false,
});

// Reemplazar el Swal global con la configuración por defecto
window.Swal = defaultSwalConfig;

// Función para mostrar alertas de éxito
window.showSuccess = function (title, message, options = {}) {
    const config = Object.assign(
        {
            title: title,
            text: message,
            icon: 'success',
            confirmButtonText: 'Aceptar',
            timer: 3000,
            timerProgressBar: true,
            showCloseButton: true,
        },
        options
    );

    return Swal.fire(config);
};

// Función para mostrar alertas de error
window.showError = function (title, message, options = {}) {
    const config = Object.assign(
        {
            title: title,
            text: message,
            icon: 'error',
            confirmButtonText: 'Aceptar',
            showCloseButton: true,
        },
        options
    );

    return Swal.fire(config);
};

// Función para confirmaciones generales
window.showConfirm = function (title, message, confirmText = 'Confirmar', cancelText = 'Cancelar', options = {}) {
    const config = Object.assign(
        {
            title: title,
            text: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
            reverseButtons: true,
            focusCancel: true,
        },
        options
    );

    return Swal.fire(config);
};

// Función específica para confirmación de eliminación (usa el SweetAlertManager)
window.confirmDelete = function (itemName, onConfirm, onCancel) {
    if (typeof window.SweetAlertManager !== 'undefined') {
        return window.SweetAlertManager.confirmDelete({
            itemName: itemName,
            onConfirm: onConfirm || (() => {}),
            onCancel: onCancel || (() => {}),
        });
    } else {
        // Fallback si el manager no está disponible
        const result = confirm(`¿Estás seguro de que deseas eliminar "${itemName}"? Esta acción no se puede deshacer.`);
        if (result && onConfirm) onConfirm();
        else if (!result && onCancel) onCancel();
        return Promise.resolve({ isConfirmed: result });
    }
};

console.log('SweetAlert2 cargado correctamente con configuraciones mejoradas');
