<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrado de César</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="body">
    <div class="container">
        <h1>CIFRADO DE CÉSAR</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="clave">Clave:</label>
                <input type="text" id="clave" name="clave" required pattern="^-?\d+$"
                    title="Ingrese solo números enteros" <?php if (isset($_POST["clave"]))
                        echo "value='{$_POST["clave"]}'"; ?>>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <input type="text" id="mensaje" name="mensaje" required pattern="[A-ZÑ\s]+"
                    title="Ingrese solo letras mayúsculas y espacios" <?php if (isset($_POST["mensaje"]))
                        echo "value='{$_POST["mensaje"]}'"; ?>>
            </div>
            <input type="hidden" id="mensaje_encriptado" name="mensaje_encriptado"
                value="<?php echo isset($mensaje_encriptado) ? $mensaje_encriptado : ''; ?>">
            <button type="submit" name="accion" value="encriptar">Encriptar</button>
            <button type="submit" name="accion" value="desencriptar" <?php if (!empty($_POST["mensaje_encriptado"]))
                echo "disabled"; ?>>Desencriptar</button>
            <button type="button" onclick="limpiarFormulario()">Intentar de Nuevo</button>
        </form>
        <div id="resultado">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"])) {
                $clave = (int) $_POST["clave"];
                $mensaje = mb_strtoupper($_POST["mensaje"], 'UTF-8');

                require_once 'metodo.php';

                if ($_POST["accion"] == "encriptar") {
                    $mensaje_encriptado = cifrarCesar($mensaje, $clave);
                    echo "<p>Mensaje encriptado: $mensaje_encriptado</p>";
                    echo "<script>document.getElementById('mensaje_encriptado').value = '$mensaje_encriptado';</script>";
                } elseif ($_POST["accion"] == "desencriptar") {
                    if (isset($_POST["mensaje_encriptado"]) && !empty($_POST["mensaje_encriptado"])) {
                        $mensaje_encriptado = $_POST["mensaje_encriptado"];
                        $mensaje_desencriptado = descifrarCesar($mensaje_encriptado, $clave);
                        echo "<p>Mensaje desencriptado: $mensaje_desencriptado</p>";
                    } else {
                        echo "<p>No hay mensaje encriptado para desencriptar.</p>";
                    }
                }
            }
            ?>
        </div>
    </div>

    <script>
        function limpiarFormulario() {
            document.getElementById("clave").value = "";
            document.getElementById("mensaje").value = "";
            document.getElementById("mensaje_encriptado").value = "";
            document.getElementById("resultado").innerHTML = ""; // Limpiar resultado
        }
    </script>
</body>

</html>
