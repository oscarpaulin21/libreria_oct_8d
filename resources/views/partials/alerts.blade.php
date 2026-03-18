@if(session('success'))
    <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i>
        <!-- obtener el mensaje desde la sesión -->
        <strong class="mx-2">¡Éxito!</strong>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


    <script>
        // Código JavaScript para manejar la alerta
        setTimeout(function() {
            var alertElement = document.querySelector('.alert');
            if (alert) {
                // Quitar clase que permite ver la alerta 
                alert.classList.remove('show');
                // Añadir animación Fade
                alert.classList.add('fade');

                setTimeout(function() {
                    alert.remove(); // Eliminar la alerta del DOM después de la animación
                }, 500); // Tiempo para que la animación se complete (ajusta según tu CSS)
            }
        }, 3000); // Cierra la alerta después de 3 segundos
    </script>
@endif