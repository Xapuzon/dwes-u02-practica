<?php
$tituloPagina = 'Inicio';

require __DIR__ . '/includes/header.inc.php';
require __DIR__ . '/includes/menu.inc.php';
?>
    <main class="contenedor">
        <section class="portada">
            <h2>Bienvenido al casino</h2>
            <p>Dos juegos con baraja francesa, repartidos por PHP en cada partida. Pasa a la mesa que prefieras.</p>

            <div class="juegos">
                <a class="juego" href="blackjackXapuzon.php">
                    <span class="juego-icono">&#9824;</span>
                    <h3>Blackjack</h3>
                    <p>La banca contra cinco jugadores. Acércate a 21 sin pasarte.</p>
                </a>
                <a class="juego" href="higherXapuzon.php">
                    <span class="juego-icono">&#9829;</span>
                    <h3>Higher</h3>
                    <p>Dos jugadores, diez duelos. Gana la carta más alta.</p>
                </a>
            </div>
        </section>

        <section class="autor">
            <img class="avatar" src="img/avatar.png" alt="Avatar de Xapuzon">
            <p>Autor: <strong>Xapuzon</strong></p>
        </section>
    </main>

<?php
require __DIR__ . '/includes/footer.inc.php';