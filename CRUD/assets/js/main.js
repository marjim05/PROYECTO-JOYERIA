// JavaScript personalizado para el dashboard de Joyería Winlux

document.addEventListener('DOMContentLoaded', function() {

    // Auto-hide alerts después de 5 segundos
    const alerts = document.querySelectorAll('.alert');
    alerts.for(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Confirmación para eliminar elementos
    const deleteButtons = document.querySelectorAll('[onclick*="confirm"]');
    deleteButtons.for(function(button) {
        button.addEventListener('click', function(e) {
            if (!confirm('¿Estás seguro de que quieres realizar esta acción?')) {
                e.preventDefault();
            }
        });
    });

    // Validación de formularios (solo visual, no bloquea envío)
    const forms = document.querySelectorAll('form');
    forms.for(function(form) {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.for(function(field) {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            // Solo mostrar alerta, no prevenir envío
            if (!isValid) {
                showAlert('Por favor, completa todos los campos requeridos.', 'danger');
            }
        });
    });

    // Formatear números en tiempo real
    const priceInputs = document.querySelectorAll('input[name="precio"]');
    priceInputs.for(function(input) {
        input.addEventListener('input', function() {
            let value = this.value.replaceAll(/\D/g, '');
            if (value) {
                this.value = Number.parseInt(value).toLocaleString();
            }
        });
    });

    // Búsqueda en tiempo real (opcional)
    const searchInput = document.querySelector('input[name="q"]');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                // Aquí se podría implementar búsqueda AJAX
            }, 500);
        });
    }

    // Animación de carga para botones (simplificada)
    const submitButtons = document.querySelectorAll('button[type="submit"]');
    submitButtons.for(function(button) {
        button.addEventListener('click', function() {
            // Solo cambiar el texto, no deshabilitar
            const originalText = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Procesando...';
            
            // Restaurar después de 2 segundos si no hay redirección
            setTimeout(function() {
                if (button.innerHTML.includes('Procesando')) {
                    button.innerHTML = originalText;
                }
            }, 2000);
        });
    });
});

// Función para mostrar alertas dinámicas
function showAlert(message, type = 'info') {
    const alertContainer = document.createElement('div');
    alertContainer.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    alertContainer.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertContainer.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertContainer);
    
    // Auto-remove después de 5 segundos
    setTimeout(function() {
        const bsAlert = new bootstrap.Alert(alertContainer);
        bsAlert.close();
    }, 5000);
}

// Función para formatear precios
function formatPrice(price) {
    return new Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: 'COP',
        minimumFractionDigits: 0
    }).format(price);
}


// Función para mostrar preview de imagen
function showImagePreview(input) {
    if (input.files?.[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
