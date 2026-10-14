<?php
$tituloPagina = 'Inicio';

require __DIR__ . '/includes/header.inc.php';
require __DIR__ . '/includes/menu.inc.php';
?>
    <main>
        <h2>Bienvenido a los juegos de cartas</h2>
        <p>Pequeña aplicación web hecha con PHP que incluye dos juegos con baraja francesa: Higher y Blackjack.</p>

        <p>
            <a href="higherXapuzon.php">Jugar a Higher</a> |
            <a href="blackjackXapuzon.php">Jugar a Blackjack</a>
        </p>

        <img class="avatar" src="img/avatar.png" alt="Avatar de Xapuzon">
        <p>Autor: Xapuzon</p>
    </main>

<?php
require __DIR__ . '/includes/footer.inc.php';