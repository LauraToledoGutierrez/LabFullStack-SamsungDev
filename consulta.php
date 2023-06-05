<!-- Laboratorio Desarrollo Full-Stack Samsung Desarrolladoras 2022/23. Laura Toledo Gutiérrez -->

<!DOCTYPE html>
<html>
<head>
    <title>Lista de usuarios registrados</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        h2{
            color: #153B49;
            font-size: 20px;
            font-family: 'Titillium Web', sans-serif;
        }

        th{
            border: 1px solid black;
            padding: 8px;
            color: yellow;
            font-family: 'Titillium Web', sans-serif;
        }
        td {
            border: 1px solid black;
            padding: 8px;
            color: black;
            font-family: 'Titillium Web', sans-serif;
        }

        th {
            background-color: #153B49;
        }
    </style>
</head>
<body>
    <?php
    // Conexión PDO
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "laboratorio";

    // Crea la conexión con la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Crea una consulta SQL para ver los usuarios registrados
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);
    // Muestra los usuarios registrados
    if ($result->num_rows > 0) {
        // Muestra los datos en forma de tabla
        echo "<h2>Lista de usuarios registrados:</h2>";
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th><th>Login</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["apellido1"] . "</td>";
            echo "<td>" . $row["apellido2"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["login"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron usuarios registrados.";
    }

    // Cierra la conexión con la base de datos
    $conn->close();
    ?>
</body>
</html>
