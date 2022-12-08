<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(403);
    die();
}

$host       = "localhost:3306";
$user       = "root";
$password   = "";
$db         = "siswa";

$conn       = mysqli_connect($host, $user, $password, $db);

if ($conn->connect_errno) {
    echo `<script>
    location.href = "./?status=failed&type=insert&error=`. $conn->connect_error .`";
</script>`;

    die("MySQL connection failed: " . $conn->connect_error);
}

$name       = $_REQUEST["name"];
$nis        = $_REQUEST["nis"];
$gender     = $_REQUEST["gender"];
$major      = $_REQUEST["major"];
$address    = $_REQUEST["address"];

$sql        = "
INSERT INTO data (name, nis, gender, major, address)
    VALUES ('$name', '$nis', '$gender', '$major', '$address')";

$result = $conn->query($sql);

if (!$result) {
    echo '<script>location.href = "./?status=failed&type=insert&error='. $result->errno .'";</script>';
    die("Failed to insert");
}
?>

<script>
    location.href = "./?status=success&type=insert";
</script>