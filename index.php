<!DOCTYPE html>
<html>
    <head>
        <!-- Configuración general -->
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link href='https://fonts.googleapis.com/css?family=Red Rose' rel='stylesheet'>
        <title>Tiempo CDT - <?php echo date("d/m") ?></title>
    </head>
    <body>
        <!-- Codigo PHP para obtener los datos -->
        <?php
        //Datos BD
        $server = "localhost";
        $usuario = "root";
        $clave = "";
        $bd = "webtiempo";
        
        //Conexión
        $conn = new mysqli($server, $usuario, $clave, $bd);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Conseguir fecha actual
        $fecha = date("Y-m-d");

        //Consultar tiemp con la fecha
        $sql = "SELECT * FROM tiempo WHERE fecha = '$fecha'";
        $result = $conn->query($sql);

        //Recorrer datos si los hay y almacenarlos en variables
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $temperatura = $row["temperatura"];
            $estado = $row["estado"];
            $tempMax = $row["tempmax"];
            $tempMin = $row["tempmin"];
            $lluvia = $row["lluvia"];
            $humedad = $row["humedad"];
        } else {
            echo "0 resultados en tabla TIEMPO";
        }

        //Consultar temperatura y estado por horas con la fecha
        $sql = "SELECT * FROM tiempohoras WHERE fecha = '$fecha'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $doceAM = $row["doceAM"];
            $dosAM = $row["dosAM"];
            $cuatroAM = $row["cuatroAM"];
            $seisAM = $row["seisAM"];
            $ochoAM = $row["ochoAM"];
            $diezAM = $row["diezAM"];
            $docePM = $row["docePM"];
            $estadoDoceAM = $row["estadoDoceAM"];
            $estadoDosAM = $row["estadoDosAM"];
            $estadoCuatroAM = $row["estadoCuatroAM"];
            $estadoSeisAM = $row["estadoSeisAM"];
            $estadoOchoAM = $row["estadoOchoAM"];
            $estadoDiezAM = $row["estadoDiezAM"];
            $estadoDocePM = $row["estadoDocePM"];
        } else {
            echo "0 resultados en tabla TIEMPOHORAS";
        }

        //Cerrar conexión
        $conn->close();
        ?>
        
        <!-- Cabecera con la fecha actual con PHP -->
        <div class="header">Tiempo en el CDT de Motril - <?php echo date("d/m"); ?></div>

        <!-- Div con los datos del día de hoy -->
        <div class="current">
            <table class="currentTable">
                <tr>
                    <td>
                        <div>
                            <img class="currentIcon" src="
                            <?php
                            switch ($estado) {
                                case "Nublado":
                                    echo "res/nublado.png";
                                break;
                                case "Soleado":
                                    echo "res/soleado.png";
                                break;
                                case "Lluvia":
                                    echo "res/lluvia.png";
                                break;
                            }
                            ?>
                            ">
                            
                            <p class="currentTemp">
                                <?php echo $temperatura; ?> ºC
                                <br>
                                <?php echo $tempMin, "ºC - ", $tempMax; ?> ºC
                            </p>
                        </div>      
                        <p class="currentState"><?php echo $estado?></p>
                        <br>
                    </td> 
                    <td>
                        <ul>
                            <li>Probabilidad de lluvia: <?php echo $lluvia; ?>%</li>
                            <li>Humedad: <?php echo $humedad; ?>%</li>
                            <li>Respecto al año pasado: null</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Div con las temperaturas del día actual -->
        <!--
        Con las nociones basicas en web que tengo hasta ahora no sé cómo podría poner la flecha del boceto
        y asignarle una animacion para recorra la tabla y muestre los demás tramos horarios. Supongo que
        será con JavaScript pero no sé cómo hacerlo. Igualmente los campos ya existen en la base de datos
        asi que solo faltaría añadirle esta funcionalidad.

        Tambien se me ocurre reducir los tramos horarios para no necesitar la flecha que puse en el boceto.
        -->
        <div class="current">
            <table class="weeklyTable">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="tableHeader">Pronostico por horas</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                
                <tr>
                    <td>
                        <p class="weeklyTime">00:00</p>
                        <img class="weeklyIcon" src="
                            <?php
                            //Elegir la imagen dependiendo del estado
                            switch ($estadoDoceAM) {
                                case "Nublado":
                                    echo "res/nublado.png";
                                break;
                                case "Soleado":
                                    echo "res/soleado.png";
                                break;
                                case "Lluvia":
                                    echo "res/lluvia.png";
                                break;
                            }
                            ?>
                        ">

                        <p class="weeklyTime"><?php echo $doceAM; ?>ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">02:00</p>
                        <img class="weeklyIcon" src="
                            <?php
                            //Elegir la imagen dependiendo del estado
                            switch ($estadoDosAM) {
                                case "Nublado":
                                    echo "res/nublado.png";
                                break;
                                case "Soleado":
                                    echo "res/soleado.png";
                                break;
                                case "Lluvia":
                                    echo "res/lluvia.png";
                                break;
                            }
                            ?>
                        ">

                        <p class="weeklyTime"><?php echo $dosAM; ?>ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">04:00</p>
                        <img class="weeklyIcon" src="
                            <?php
                            //Elegir la imagen dependiendo del estado
                            switch ($estadoCuatroAM) {
                                case "Nublado":
                                    echo "res/nublado.png";
                                break;
                                case "Soleado":
                                    echo "res/soleado.png";
                                break;
                                case "Lluvia":
                                    echo "res/lluvia.png";
                                break;
                            }
                            ?>
                        ">

                        <p class="weeklyTime"><?php echo $cuatroAM; ?>ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">06:00</p>
                        <img class="weeklyIcon" src="
                            <?php
                            //Elegir la imagen dependiendo del estado
                            switch ($estadoSeisAM) {
                                case "Nublado":
                                    echo "res/nublado.png";
                                break;
                                case "Soleado":
                                    echo "res/soleado.png";
                                break;
                                case "Lluvia":
                                    echo "res/lluvia.png";
                                break;
                            }
                            ?>
                        ">

                        <p class="weeklyTime"><?php echo $seisAM; ?>ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">08:00</p>
                        <img class="weeklyIcon" src="
                            <?php
                            //Elegir la imagen dependiendo del estado
                            switch ($estadoOchoAM) {
                                case "Nublado":
                                    echo "res/nublado.png";
                                break;
                                case "Soleado":
                                    echo "res/soleado.png";
                                break;
                                case "Lluvia":
                                    echo "res/lluvia.png";
                                break;
                            }
                            ?>
                        ">

                        <p class="weeklyTime"><?php echo $ochoAM; ?>ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">10:00</p>
                        <img class="weeklyIcon" src="
                            <?php
                            //Elegir la imagen dependiendo del estado
                            switch ($estadoDiezAM) {
                                case "Nublado":
                                    echo "res/nublado.png";
                                break;
                                case "Soleado":
                                    echo "res/soleado.png";
                                break;
                                case "Lluvia":
                                    echo "res/lluvia.png";
                                break;
                            }
                            ?>
                        ">

                        <p class="weeklyTime"><?php echo $diezAM; ?>ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">12:00</p>
                        <img class="weeklyIcon" src="
                            <?php
                            switch ($estadoDocePM) {
                                case "Nublado":
                                    echo "res/nublado.png";
                                break;
                                case "Soleado":
                                    echo "res/soleado.png";
                                break;
                                case "Lluvia":
                                    echo "res/lluvia.png";
                                break;
                            }
                            ?>
                        ">
                        <p class="weeklyTime"><?php echo $docePM; ?>ºC</p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Div con las temperaturas de la semana -->
        <!--
        Con las nociones basicas de PHP que tengo hasta ahora no se me ocurre cómo podría mostrar
        el pronostico de 7 dias teniendo en cuenta el día que es hoy y mostrando los siguientes dias
        que correspondan a la fecha actual.
        -->
        <div class="current">
            <table class="weeklyTable">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="tableHeader">Pronostico semanal</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <p class="weeklyTime">Hoy</p>
                        <img class="weeklyIcon" src="res/nublado.png">
                        <p class="weeklyTime">22ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">Mañana</p>
                        <img class="weeklyIcon" src="res/nublado.png">
                        <p class="weeklyTime">21ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">Miercoles</p>
                        <img class="weeklyIcon" src="res/lluvia.png">
                        <p class="weeklyTime">20º</p>
                    </td>
                    <td>
                        <p class="weeklyTime">Jueves</p>
                        <img class="weeklyIcon" src="res/nublado.png">
                        <p class="weeklyTime">21ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">Viernes</p>
                        <img class="weeklyIcon" src="res/soleado.png">
                        <p class="weeklyTime">22ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">Sabado</p>
                        <img class="weeklyIcon" src="res/soleado.png">
                        <p class="weeklyTime">23ºC</p>
                    </td>
                    <td>
                        <p class="weeklyTime">Domingo</p>
                        <img class="weeklyIcon" src="res/lluvia.png">
                        <p class="weeklyTime">24ºC</p>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>