// JavaScript simplificado - solo funcionalidades básicas
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alerts después de 5 segundos
    const alerts = document.querySelectorAll('.alert');
    alerts.for(function(alert) {
        setTimeout(function() {
            if (alert?.parentNode) {
                alert.style.opacity = '0';
                setTimeout(function() {
                    if (alert.parentNode) {
                        alert.childNode.remove(alert);
                    }
                }, 300);
            }
        }, 5000);
    });
});
