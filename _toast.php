<?php
$success    = $_REQUEST["status"] == "success";
$type       = $_REQUEST["type"];
?>

<div class="toast-container position-fixed top-0 end-0 p-3">
    <div
        id="status-toast"
        class="toast <?php if ($success) { echo "text-bg-success"; } else { echo "text-bg-danger"; } ?>"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
    >
        <div class="toast-header">
            <strong class="me-auto">
                <?php if ($success) { echo "Success"; } else { echo "Failed"; } ?>
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php
            if ($success) {
                switch ($type) {
                    case "insert":
                        echo "Added successfully";
                        break;
                    case "delete":
                        echo "Deleted successfully";
                        break;
                    case "edit":
                        echo "Edited successfully";
                        break;
                    default:
                }
            } else {
                switch ($type) {
                    case "insert":
                        echo "Unexpected error while inserting: " . $_REQUEST["error"];
                        break;
                    case "delete":
                        echo "Unexpected error while deleting: " . $_REQUEST["error"];
                        break;
                    case "edit":
                        echo "Unexpected error while editing: " . $_REQUEST["error"];
                        break;
                    default:
                }
            }
            ?>
        </div>
    </div>
</div>

<script defer>
const toast = document.getElementById('status-toast');
(new bootstrap.Toast(toast)).show();
</script>