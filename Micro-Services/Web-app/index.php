<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Database</title>
</head>
<body>

    <h1>List of Cities</h1>

    <?php
    // Connect to MySQL database
    $servername = "mysql-service";
    $username = "aymen";
    $password = "aymen";
    $dbname = "city_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected to MySQL successfully";
    // Fetch data from the "cities" table
    $sql = "SELECT * FROM cities";
    $result = $conn->query($sql);

    // Display the list of cities
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["name"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No cities found.";
    }

    // Close the MySQL connection
    $conn->close();
    ?>

</body>
</html>
