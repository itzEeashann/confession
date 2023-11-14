<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous Confession</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        .login-container {
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }

        .login-container h2 {
            color: #333333;
        }

        .login-container textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical; /* Allow vertical resizing */
        }

        .login-container button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $confession = $_POST["confession"];

    $confession = htmlspecialchars(trim($confession));

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "anon";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO confession (confession_text) VALUES ('$confession')";

    if ($conn->query($sql) === TRUE) {
        echo ("<script LANGUAGE='JavaScript'> window.alert('Confession submitted successfully!');</script>");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<div class="login-container">
    <h2>Anonymous Confession</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <textarea name="confession" id="confession" placeholder="Confession" required></textarea>
        <button type="submit">Submit Confession</button>
    </form>
</div>

</body>
</html>

