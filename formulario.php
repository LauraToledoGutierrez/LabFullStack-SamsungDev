<!-- Laboratorio Desarrollo Full-Stack Samsung Desarrolladoras 2022/23. Laura Toledo Gutiérrez -->

<?php 

    // Comprueba si se ha enviado algun dato
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

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

        // Recoge los datos enviados a traves del formulario
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Validación de campos obligatorios
        if (empty($nombre) || empty($apellido1) || empty($email) || empty($login) || empty($password)) {
            echo "Por favor, completa todos los campos obligatorios.";
        } else {
            // Validación del formato de correo electrónico
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "El correo electrónico ingresado no es válido.";
            }
            // Validación de longitud de contraseña
            elseif (strlen($password) < 4 || strlen($password) > 8) {
                echo "La contraseña debe tener una longitud entre 4 y 8 caracteres.";
            } else {
                // Verificamos si ya existe el email en la base de datos
                // Se crea una consulta SQL para seleccionar todos los emails de la base de datos
                $sql = "SELECT * FROM usuarios WHERE email = '$email'";
                $result = $conn->query($sql);
                // Comprueba si ya está el email introducido en la base de datos
                if ($result->num_rows > 0) {
                    echo "El correo electrónico ingresado ya está registrado.";
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
                    }
                }
            }
        }

        // Cierra la conexion con la base de datos
        $conn->close();
    }
?>