<?php
require __DIR__ . '/getdeck.php';
require __DIR__ . '/includes/funciones.inc.php';

function enfrentar(array $cartaUno, array $cartaDos): array
{
    $comodinUno = $cartaUno['palo'] === 'comodin';
    $comodinDos = $cartaDos['palo'] === 'comodin';

    if ($comodinUno && $comodinDos) {
        return ['puntosUno' => -2, 'puntosDos' => -2, 'texto' => 'Ambos tienen comodín'];
    }

    if ($comodinUno) {
        return ['puntosUno' => 2, 'puntosDos' => -1, 'texto' => 'Comodín del jugador 1'];
    }

    if ($comodinDos) {
        return ['puntosUno' => -1, 'puntosDos' => 2, 'texto' => 'Comodín del jugador 2'];
    }

    if ($cartaUno['valor'] === $cartaDos['valor']) {
        return ['puntosUno' => 1, 'puntosDos' => 1, 'texto' => 'Empate'];
    }

    if ($cartaUno['valor'] > $cartaDos['valor']) {
        return ['puntosUno' => 2, 'puntosDos' => 0, 'texto' => 'Gana el jugador 1'];
    }

    return ['puntosUno' => 0, 'puntosDos' => 2, 'texto' => 'Gana el jugador 2'];
}

$baraja = obtenerBaraja();
shuffle($baraja);

$manos = repartir($baraja, 2, 10);

$resultados = [];
$totalUno = 0;
$totalDos = 0;

for ($indice = 0; $indice < 10; $indice++) {
    $resultado = enfrentar($manos[0][$indice], $manos[1][$indice]);
    $resultados[] = $resultado;
    $totalUno += $resultado['puntosUno'];
    $totalDos += $resultado['puntosDos'];
}

if ($totalUno > $totalDos) {
    $mensajeFinal = 'Gana el jugador 1';
} elseif ($totalDos > $totalUno) {
    $mensajeFinal = 'Gana el jugador 2';
} else {
    $mensajeFinal = 'Empate';
}

$tituloPagina = 'Higher';

require __DIR__ . '/includes/header.inc.php';
require __DIR__ . '/includes/menu.inc.php';
?>
    <main>
        <h2>Higher</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Ronda</th>
                    <th>Jugador 1</th>
                    <th>Jugador 2</th>
                    <th>Resultado</th>
                    <th>Puntos J1</th>
                    <th>Puntos J2</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $indice => $resultado) { ?>
                    <tr>
                        <td><?= $indice + 1 ?></td>
                        <td><?= mostrarCarta($manos[0][$indice]) ?></td>
                        <td><?= mostrarCarta($manos[1][$indice]) ?></td>
                        <td><?= $resultado['texto'] ?></td>
                        <td><?= $resultado['puntosUno'] ?></td>
                        <td><?= $resultado['puntosDos'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Puntuación total</h3>
        <p>Jugador 1: <?= $totalUno ?></p>
        <p>Jugador 2: <?= $totalDos ?></p>
        <h3><?= $mensajeFinal ?></h3>
    </main>

<?php
require __DIR__ . '/includes/footer.inc.php';