<?php

echo "<table><tbody>";
echo "<tr id='F13'>";
$butArriba = 0;
for ($i = 24; $i >= 1; $i--) {
    $butArriba++;
    if ($butArriba >= 10) {
        echo "<td><input type='image' src='src/img/butacaDisponible.png' name='butaca' value='disponible' id='B$butArriba'></td>";
    } else {
        echo "<td><input type='image' src='src/img/butacaDisponible.png' name='butaca' value='disponible' id='B0$butArriba'></td>";
    }
}
echo "</tr>";

$numFila = 13;
for ($i = 1; $i <= 12; $i++) {
    $numButaca = 0;
    $numFila--;
    if ($numFila >= 10) {
        echo "<tr id='F$numFila'>";
    } else {
        echo "<tr id='F0$numFila'>";
    }
    for ($izq = 1; $izq <= 10; $izq++) {
        $numButaca++;
        if ($numButaca >= 10) {
            echo "<td><input type='image' src='src/img/butacaDisponible.png' name='butaca' value='disponible' id='B$numButaca'></td>";
        } else {
            echo "<td><input type='image' src='src/img/butacaDisponible.png' name='butaca' value='disponible' id='B0$numButaca'></td>";
        }
    }

    for ($blanco = 1; $blanco <= 4; $blanco++) {
        echo "<td><input type='image' src='src/img/transparente.png' disabled></td>";
    }

    for ($der = 1; $der <= 10; $der++) {
        $numButaca++;
        if ($numButaca >= 10) {
            echo "<td><input type='image' src='src/img/butacaDisponible.png' name='butaca' value='disponible' id='B$numButaca'></td>";
        } else {
            echo "<td><input type='image' src='src/img/butacaDisponible.png' name='butaca' value='disponible' id='B0$numButaca'></td>";
        }
    }
    echo "</tr>";
}
echo "</tbody></table>";
