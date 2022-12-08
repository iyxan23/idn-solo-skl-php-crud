<?php
$sql = "SELECT * FROM data";
$result = $conn->query($sql);
?>

<div class="table-responsive">
    <table class="table table-striped caption-top">
    <caption>Inserted students' data</caption>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nama</th>
            <th scope="col">NIS</th>
            <th scope="col">Gender</th>
            <th scope="col">Major</th>
            <th scope="col">Address</th>
            <th scope="col" class="text-end">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!$result) {
            die("Error while retrieving the table `data`: " . $conn->errno);
        }
    
        while ($row = $result->fetch_assoc()) {
            echo
            '<tr>
                <th scope="row">'. $row["id"] .'</th>
                <td>'. $row["name"] .'</td>
                <td>'. $row["nis"] .'</td>
                <td>'. $row["gender"] .'</td>
                <td>'. $row["major"] .'</td>
                <td>'. $row["address"] .'</td>
                <td class="d-flex table-light flex-wrap gap-2 justify-conent-around">
                    <div class="flex-grow-1 btn btn-primary" id="edit-btn" data-id="'. $row["id"] .'">Edit</div>
                    <div class="flex-grow-1 btn btn-danger" id="delete-btn" data-id="'. $row["id"] .'">Delete</div>
                </td>
            </tr>';
        }
        ?>
    </tbody>
    </table>
</div>

<script>
const onEditPressed = (elem) => {
    const id = elem.srcElement.dataset.id;
    window.location.href = `./?status=edit&id=${id}`;
};

const onDeletePressed = (elem) => {
    const id = elem.srcElement.dataset.id;
    window.location.href = `./delete_siswa.php?id=${id}`;
};

for (elem of document.querySelectorAll("#edit-btn")) { elem.onclick = onEditPressed; }
for (elem of document.querySelectorAll("#delete-btn")) { elem.onclick = onDeletePressed; }
</script>

<?php $result->free_result(); ?>