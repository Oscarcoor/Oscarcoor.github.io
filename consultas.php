<!doctype html>
<html lang="es">
<head>
    <title>Consultas sobre la base de datos</title>
    <link rel="stylesheet" href="./CSS/basicos.css">
    <link rel="stylesheet" href="./CSS/consultas.css">
</head>
<body>
<header>
    <nav>
        <a href="./Redes.html">Redes</a>
        <a href="./BBDD.html">BBDD</a>
        <a href="./BBDD.html">S.O</a>
        <a href="./Presupuestos.html">Presupuestos</a>
        <a href="./index.html">Pagina Principal</a>
    </nav>
</header>
    <main>
        <section>
            <h1>Horario de primero</h1>
            <?php
            $usuario = "dbadm";
            $contrasena = "aaa111!!!";
            $servidor = "localhost";
            $basededatos = "asir";

            $conexion = mysqli_connect( $servidor, $usuario, "$contrasena" ) or die ("No se ha podido conectar al servidor de Base de datos");
            $db = mysqli_select_db( $conexion, $basededatos );
            $Consulta1 = "SELECT NOMBRE_DIA,concat_ws('-',HORA_INI,HORA_FIN) AS HORA, M.NOMBRE_MODULO FROM HORARIOS H
            JOIN MODULOS M USING (COD_MOD)
            WHERE N_CURSO='1' ORDER BY 1,2;";
            $resultado = mysqli_query( $conexion, $Consulta1 );
            echo "<table>";
            echo "<tr><th>DIA</th>";
            echo "<th>HORA</th>";
            echo "<th>MODULO</th></tr>";
            $fila=mysqli_fetch_assoc($resultado);
            while($fila){
                $nombre=$fila["NOMBRE_DIA"];
                echo "<tr><td>$nombre</td>";

                $hora=$fila["HORA"];
                echo "<td>$hora</td>";

                $modulo=$fila["NOMBRE_MODULO"];
                echo "<td>$modulo</td></tr>";

                $fila=mysqli_fetch_assoc($resultado);
            }
            echo "</table>";
                ?>
        </section>
        <section>
                <h1>Horario de Segundo</h1>
                <?php
                $Consulta2 = "SELECT NOMBRE_DIA,concat_ws('-',HORA_INI,HORA_FIN) AS HORA, M.NOMBRE_MODULO FROM HORARIOS H
                JOIN MODULOS M USING (COD_MOD)
                WHERE N_CURSO='2' ORDER BY 1,2;";
                        $resultado = mysqli_query( $conexion, $Consulta2 );
                        echo "<table>";
                        echo "<tr><th>DIA</th>";
                        echo "<th>HORA</th>";
                        echo "<th>MODULO</th></tr>";
                        $fila=mysqli_fetch_assoc($resultado);
                        while($fila){
                            $nombre=$fila["NOMBRE_DIA"];
                            echo "<tr><td>$nombre</td>";

                            $hora=$fila["HORA"];
                            echo "<td>$hora</td>";

                            $modulo=$fila["NOMBRE_MODULO"];
                            echo "<td>$modulo</td></tr>";

                            $fila=mysqli_fetch_assoc($resultado);
                        }
                echo "</table>";
                ?>
                </section>
        <section>
            <h1>Tareas Realizadas y notas globales de todos los alumnos en todos los cursos</h1>

            <?php
            $Consulta3 = "SELECT A.NOMBRE, T.N_TAREA,M.NOMBRE_MODULO ,NOTA FROM ALUMNOS A
JOIN REALIZAR R USING (DNI)
JOIN MODULOS M USING (COD_MOD)
JOIN TAREAS T USING (N_TAREA, COD_MOD) ORDER BY 4 DESC;";
            $resultado = mysqli_query( $conexion, $Consulta3 );
            echo "<table>";
            echo "<tr><th>Nombre del alumno</th>";
            echo "<th>Numero de tarea</th>";
            echo "<th>MODULO</th>";
            echo "<th>Nota</th></tr>";
            $fila=mysqli_fetch_assoc($resultado);
            while($fila){
                $nombre=$fila["NOMBRE"];
                echo "<tr><td>$nombre</td>";

                $tarea=$fila["N_TAREA"];
                echo "<td>$tarea</td>";

                $modulo=$fila["NOMBRE_MODULO"];
                echo "<td>$modulo</td>";

                $nota=$fila["NOTA"];
                echo "<td>$nota</td></tr>";

                $fila=mysqli_fetch_assoc($resultado);
            }
            echo "</table>";
            ?>
        </section>
        <section>
            <h1>Nota promedia de las tareas realizadas por los alumnos</h1>

            <?php
            $Consulta4 = "SELECT A.NOMBRE,COUNT(*) AS TAREAS_REALIZADAS,AVG(NOTA) AS NOTA_MEDIA FROM REALIZAR R
JOIN ALUMNOS A USING (DNI) GROUP BY A.NOMBRE;";
            $resultado = mysqli_query( $conexion, $Consulta4 );
            echo "<table>";
            echo "<tr><th>Nombre del alumno</th>";
            echo "<th>Tareas Realizadas</th>";
            echo "<th>Nota Media</th></tr>";
            $fila=mysqli_fetch_assoc($resultado);
            while($fila){
                $nombre=$fila["NOMBRE"];
                echo "<tr><td>$nombre</td>";

                $tarearea=$fila["TAREAS_REALIZADAS"];
                echo "<td>$tarearea</td>";

                $notamed=$fila["NOTA_MEDIA"];
                echo "<td>$notamed</td></tr>";

                $fila=mysqli_fetch_assoc($resultado);
            }
            echo "</table>";
            ?>
        </section>
    </main>
</body>
</html>
