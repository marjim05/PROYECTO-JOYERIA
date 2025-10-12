// JavaScript simplificado - solo funcionalidades básicas
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alerts después de 5 segundos
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            if (alert && alert.parentNode) {
                alert.style.opacity = '0';
                setTimeout(function() {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 300);
            }
        }, 5000);
    });
});
