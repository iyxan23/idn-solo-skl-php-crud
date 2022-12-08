<?php
$id         = NULL;
$nis        = NULL;
$name       = NULL;
$gender     = NULL;
$major      = NULL;
$address    = NULL;

$host       = "localhost:3306";
$user       = "root";
$password   = "";
$db         = "siswa";

$conn       = mysqli_connect($host, $user, $password, $db);

if ($conn->connect_errno) {
    die("MySQL connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && array_key_exists("status", $_REQUEST)) {
    if ($_REQUEST["status"] == "edit") {
        $id = $_REQUEST["id"];

        $result = $conn->query("SELECT * FROM data WHERE data.id = $id");

        if(!$result) {
            echo '<script>location.href = "./?status=failed&type=edit&error='. $result->errno .'";</script>';
            die("Failed to retrieve student with id $id");
        }

        $row = $result->fetch_assoc();

        $nis        = $row["nis"];
        $name       = $row["name"];
        $gender     = $row["gender"];
        $major      = $row["major"];
        $address    = $row["address"];
    }
}
?>

<form

    <?php
    if ($nis) {
        echo 'action="./edit_siswa.php"';
    } else {
        echo 'action="./add_siswa.php"';
    }
    ?>

    method="POST">

    <?php if ($nis): ?>
        <input
            type="hidden"
            name="id"
            value="<?=$id?>"/>
    <?php endif; ?>

    <div class="mb-3">
        <label for="ins-input" class="form-label"
            >NIS</label
        >
        <input
            type="number"
            class="form-control"
            id="nis-input"
            placeholder="0073172266"
            name="nis"

            <?php if ($nis): ?>
            value="<?=$nis?>"
            disabled
            <?php endif; ?>
        />
    </div>

    <div class="mb-3">
        <label for="name-input" class="form-label"
            >Name</label
        >
        <input
            type="text"
            class="form-control"
            id="name-input"
            placeholder="Nur Ihsan Al Ghifari"
            name="name"
            
            <?php if ($name): ?>
            value="<?=$name?>"
            <?php endif; ?>
        />
    </div>

    <div class="mb-3">
        <label for="gender-input" class="form-label"
            >Gender</label
        >
        <select
            class="form-select"
            aria-label="Gender selection"
            name="gender"
        >
            <option <?php if (!$gender): ?>selected<?php endif; ?> >=== Choose Gender ===</option>
            <option <?php if ($gender == "Male"): ?>selected<?php endif; ?> value="Male">Male</option>
            <option <?php if ($gender == "Female"): ?>selected<?php endif; ?> value="Female">Female</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="major-input" class="form-label"
            >Major</label
        >
        <select
            class="form-select"
            aria-label="Major selection"
            name="major"
        >
            <option <?php if (!$major): ?>selected<?php endif; ?> >=== Choose Major ===</option>

            <option
                <?php if ($major == "RPL (Software Engineering)"): ?>selected<?php endif; ?>
                value="RPL (Software Engineering)"
            >RPL (Software Engineering)</option>

            <option
                <?php if ($major == "TKJ (Network Engineering)"): ?>selected<?php endif; ?>
                value="TKJ (Network Engineering)"
            >TKJ (Network Engineering)</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="address-input" class="form-label"
            >Address</label
        >
        <textarea
            class="form-control"
            placeholder="Address"
            id="address-textarea"
            name="address"><?php if ($address): ?><?=$address?><?php endif; ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        <?php
        if (!$nis) {
            echo "Submit";
        } else {
            echo "Edit";
        }
        ?>
    </button>
</form>