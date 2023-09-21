<?php

    # Creo el objeto de la clase arrayUsuarios
    $jugadores = new arrayJugadores();

    # Obtengo arrays de posiciones y equipos
    $posiciones = $jugadores->getPosiciones();
    $equipos = $jugadores->getEquipos();

    # Cargo los datos
    $jugadores->getDatos();

    # Obtengo la tabla de usuarios mediante método getArray()
    $t_jugadores = $jugadores->getArray();

?>