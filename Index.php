<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página de Inicio</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
body {
    body {
    margin: 0;
    font-family: 'Arial', sans-serif;
    background-color: #ffffff; /* Fondo oscuro */
    color: #fff; /* Texto blanco */
    padding-top: 76px; /* Ajuste para el encabezado fijo (56px + 20px) */
}

}

header {
    background-color: rgba(128, 0, 128, 1); /* Fondo morado completamente opaco */
    padding: 20px;
    text-align: center;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    transition: background-color 0.3s ease; /* Transición para el cambio de color */
}

/* Estilo cuando el encabezado está en la parte superior */
body.at-top header {
    background-color: rgba(128, 0, 128, 0); /* Fondo morado completamente transparente cuando se desplaza hacia abajo */
}

/* Alineación a la derecha y color blanco para las opciones del menú */
body.at-top #navbarNav {
    text-align: right;
}

body.at-top #navbarNav a {
    color: #fff !important;
}


section {
    height: 100vh; /* Cubrir toda la pantalla */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative; /* Importante para z-index */
    background-position: center;
    background-size: cover;
    color: #fff;
}

section#seccion5 {
    background-image: url('Fondo1.jpg');
}
section#seccion4 {
    background-image: url('Vision.png');
}
section#seccion3 {
    background-image: url('Mision.jpeg');
}
section#seccion2 {
    
    background-image: url('Centro.jpg');
}
section#seccion1 {
    padding-top: -1000px;
    background-image: url('Fondo1.jpg');
}
section#seccion1 h2,
section#seccion2 h2,
section#seccion3 h2,
section#seccion4 h2,
section#seccion1 p,
section#seccion2 p,
section#seccion3 p,
section#seccion4 p,
section#seccion5 p {
    filter: none; /* Elimina el efecto de desenfoque en los textos de las secciones */
}

section#seccion4 img {
    width: 30px; /* Reducido el tamaño de las imágenes */
    margin: 5px; /* Reducido el espacio entre las imágenes */
    width: 100%; /* Cambiado a un porcentaje para que las imágenes se ajusten al ancho de su contenedor */
    max-width: 50px; /* Establece un ancho máximo para las imágenes para evitar que sean demasiado grandes */
    height: auto; /* Hace que la altura se ajuste proporcionalmente al ancho */
    margin: 5px;
}


    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="0">

    <!-- Navbar -->
    <!-- Navbar -->
<header>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="color: #fff;">POLIMARKET</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" style="color: #fff;" href="#seccion1"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #fff;" href="#seccion2">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #fff;" href="#seccion3">Mision</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #fff;" href="#seccion4">Vision</a>
                    </li>
                    <!-- Nuevas opciones -->
                    <li class="nav-item">
                        <a class="nav-link" style="color: #fff;" href="#seccion5">Contactos</a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>
</header>


    <!-- Secciones -->
    <section id="seccion1">
        <div>

            <h1>BIENVENIDO A POLIMARKET</h1>

    <p></p>
    <!-- Botón para redirigir a Tienda.php -->
    <button style="background-color: transparent; color: white; border: 2px solid white; padding: 10px 20px; font-size: 1.2em; cursor: pointer;" onclick="window.location.href='Tienda.php';">Ir a la tienda</button>

    <br>
    <br>

    <!-- Botón para redirigir a la Sección 2 -->
    <button style="background-color: transparent; color: white; border: 2px solid white; padding: 10px 20px; font-size: 1.2em; cursor: pointer;" onclick="window.location.href='#seccion2';">Texto del Botón</button>
        </div>
        
    </section>

    <section id="seccion2">
        <div>
            <h2></h2>
            <p></p>
        </div>
    </section>

    <section id="seccion3">
        <div>
            <h2></h2>
            <p></p>
        </div>
    </section>

    <section id="seccion4">
        <div>
            <h2>Contactanos</h2>
            <img src="https://via.placeholder.com/50x50?text=FB" alt="Facebook">
            <img src="https://via.placeholder.com/50x50?text=TW" alt="Twitter">
            <img src="https://via.placeholder.com/50x50?text=IG" alt="Instagram">
        </div>
    </section>
    <section id="seccion5">
        <div>
            <h2>Sección 3</h2>
            <p>Texto de la sección 3.</p>
        </div>
    </section>

    <!-- Bootstrap JS y Popper.js (Requeridos para los componentes de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Añade la clase 'at-top' al body al cargar la página
        document.addEventListener('DOMContentLoaded', function () {
            document.body.classList.toggle('at-top', window.scrollY === 0);
        });
    
        // Añade la clase 'at-top' al body cuando el scroll está en la parte superior
        document.addEventListener('scroll', function () {
            document.body.classList.toggle('at-top', window.scrollY === 0);
        });
    </script>
    
</body>

</html>
