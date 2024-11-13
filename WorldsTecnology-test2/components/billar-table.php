<head>
    <link rel="stylesheet" href="ruta/a/main.css">
</head>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Estudiante</th>
            <th>Hora de Finalización</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $table = 'billar';
        $sql = "SELECT id, estudiante,hora_finalizacion, estado FROM $table";
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['estudiante'] . "</td>";
                echo "<td>" . $row['hora_finalizacion'] . "</td>";
                echo "<td>" . $row['estado'] . "</td>";
                echo "<td>";

                // Botones de acción
                echo '<div class="table-buttons">';

                // Botón de edición
                echo "<a href='editar.php?id=" . $row['id'] . "&table=$table'>";
                echo '<span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="white" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z" />
                        </svg>
                      </span> Editar
                    </a>';

                // Botón de limpieza
                echo "<a href='limpiar.php?id=" . $row['id'] . "&table=$table'>";
                echo '<span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                            <path fill="#071952" d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6zM8 9h8v10H8zm7.5-5l-1-1h-5l-1 1H5v2h14V4z" />
                        </svg>
                      </span> Limpiar
                    </a>';

                // Botón de bloqueo
                echo "<a href='bloquear.php?id=" . $row['id'] . "&table=$table'>";
                echo '<span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="none" stroke="#ff0000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.636 5.636a9 9 0 1 0 12.728 12.728M5.636 5.636a9 9 0 1 1 12.728 12.728M5.636 5.636L12 12l6.364 6.364" />
                        </svg>
                      </span> 
                    </a>';

                // Botón de desbloqueo
                echo "<a href='desbloquear.php?id=" . $row['id'] . "&table=$table'>";
                echo '<span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#04ff00" d="M19.78 2.2L24 6.42L8.44 22L0 13.55l4.22-4.22l4.22 4.22zm0 2.8L8.44 16.36l-4.22-4.17l-1.41 1.36l5.63 5.62L21.19 6.42z" />
                        </svg>
                      </span> 
                    </a>';

                echo '</div>'; // Fin de los botones de acción
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>

