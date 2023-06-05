<?php
    // Comprueba si se ha enviado algún dato
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Conexion con PDO
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "laboratorio";

        // Crea la conexion con la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Checkea la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Recoge los datos enviados a través del formulario
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Validación de campos obligatorios
        if (empty($nombre) || empty($apellido1) || empty($email) || empty($login) || empty($password)) {
            echo "Por favor, completa todos los campos obligatorios.<br>";
            echo "<br>Redireccionando al formulario...";
            header("refresh:2;url=index.html" );
        } else {
            // Validación del formato de correo electrónico
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "El correo electrónico ingresado no es válido.";
                echo "<br>Redireccionando al formulario...";
                header("refresh:2;url=index.html" );
            } else {
                // Validación de longitud de contraseña
                if (strlen($password) < 4 || strlen($password) > 8) {
                    echo "La contraseña debe tener una longitud entre 4 y 8 caracteres.";
                    echo "<br>Redireccionando al formulario...";
                    header("refresh:2;url=index.html" );
                } else {
                    // Verificamos si ya existe el email en la base de datos
                    // Se crea una consulta SQL para seleccionar todos los emails de la base de datos
                    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
                    $result = $conn->query($sql);
                    // Comprueba si ya está el email introducido en la base de datos
                    if ($result->num_rows > 0) {
                        echo "El correo electrónico ingresado ya está registrado.";
                        echo "<br>Redireccionando al formulario...";
                        header("refresh:2;url=index.html" );
                    } else {
                        // Encriptamos la contraseña para guardarla en la base de datos
                        $password_encriptada = password_hash($password, PASSWORD_DEFAULT);

                        // Se crea una consulta SQL para insertar los datos en la tabla "usuarios"
                        $sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, login, password)
                                VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$password_encriptada')";

                        // Comprueba si la consulta se ejecuta correctamente
                        if ($conn->query($sql) === TRUE) {
                            echo "Registro completado con éxito.";
                            echo "<button onclick=\"location.href='consulta.php'\">Consulta</button>";
                        } else {
                            echo "Error al registrar los datos: " . $conn->error;
                            echo "<br>Redireccionando al formulario...";
                            header("refresh:2;url=index.html" );
                        }
                    }
                }
            }
        }
        // Cierra la conexion con la base de datos
        $conn->close();
    }
?>
