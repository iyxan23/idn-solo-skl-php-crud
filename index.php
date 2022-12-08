<?php

$host       = "localhost:3306";
$user       = "root";
$password   = "";
$db         = "siswa";

$conn       = mysqli_connect($host, $user, $password, $db);

if ($conn->connect_errno) {
    die("MySQL connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Data Siswa</title>

        <!-- Bootstrap's CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "GET" && array_key_exists("status", $_REQUEST)) {
                                if ($_REQUEST["status"] == "edit") {
                                    echo "Edit ";
                                } else {
                                    echo "Insert ";
                                }
                            } else {
                                echo "Insert ";
                            }
                            ?>
                            Student Data
                        </div>
                        <div class="card-body">
                            <?php require "_form.php"; ?>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">DATA SISWA</div>
                        <div class="card-body">
                            <?php
                            $sql = "SELECT id FROM data";
                            $result = $conn->query($sql);
                            if ($result->num_rows == 0) {
                                echo "<div class=\"w-100 d-flex justify-content-center\">No results</div>";
                            } else {
                                $result->free_result();
                                require "_table.php";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap's JS -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"
        ></script>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && array_key_exists("status", $_REQUEST)) {
            if ($_REQUEST["status"] != "edit") {
                require "_toast.php";

                // to get rid of the `status` GET parameter
                echo '<script defer>history.replaceState(null, null, location.origin + location.pathname);</script>';
            }
        }
        ?>
    </body>
</html>

<?php $conn->close(); ?>