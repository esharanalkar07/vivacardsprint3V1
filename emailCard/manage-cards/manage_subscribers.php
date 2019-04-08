<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebook https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */


require("../libs/config.php");
$pageTitle = "Manage Subscribers";
$msg = '';
if (isset($_GET["del"]) && $_GET["del"] != "") {
    $email_id = urldecode(db_prepare_input($_GET["del"]));
    $sql = "DELETE FROM  " . TABLE_SUBSCRIBERS . " WHERE `email_id` = :em";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":em", $email_id);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $msg = successMessage("Subscriber deleted successfully.");
        } else if ($stmt->rowCount() == 0) {
            $msg = successMessage("No changes affected");
        } else {
            $msg = errorMessage("failed to delete Subscriber.");
        }
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }
} else if (isset($_GET["email_id"]) && $_GET["email_id"] != "") {
    $email_id = urldecode(db_prepare_input($_GET["email_id"]));
    $status = db_prepare_input($_GET["status"]);
    if ($email_id <> "" && $status <> "") {
        $sql = "UPDATE  " . TABLE_SUBSCRIBERS . " SET status = :st WHERE `email_id` = :em";
        try {
            $stmt = $DB->prepare($sql);
            $stmt->bindValue(":st", $status);
            $stmt->bindValue(":em", $email_id);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $msg = successMessage("Subscriber status changed successfully.");
            } else if ($stmt->rowCount() == 0) {
                $msg = successMessage("No changes affected");
            } else {
                $msg = errorMessage("failed to update status.");
            }
        } catch (Exception $ex) {
            echo errorMessage($ex->getMessage());
        }
    } else {
        $msg = errorMessage("All fields are mandatory");
    }
}
include("header.php");
?>   
<?php echo $msg; ?>
<div class="title" style="text-align:right;"><a href="add_subscribers.php">Add New Subscriber</a></div>
<table class="bordered">
    <tr>
        <th ><strong>Email</strong> </th>
        <th><strong>Status</strong> </th>
        <th><strong>Action</strong> </th>
    </tr>
    <?php
    $sql = "SELECT * FROM " . TABLE_SUBSCRIBERS . " WHERE 1 ORDER BY email_id ASC";

    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $subResults = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }

    if (count($subResults) > 0) {
        foreach ($subResults as $rs) {
            ?>
            <tr>
                <td ><?php echo stripslashes($rs["email_id"]); ?></td>
                <td>
                    <?php if ($rs["status"] == 'A') { ?>
                        <a href="manage_subscribers.php?email_id=<?php echo urlencode($rs["email_id"]); ?>&status=I" title="Click to make it Inactive">Active</a>
                    <?php } else { ?>
                        <a href="manage_subscribers.php?email_id=<?php echo urlencode($rs["email_id"]); ?>&status=A" title="Click to make it Active">In Active</a>
                    <?php } ?>

                </td>
                <td><a href="manage_subscribers.php?del=<?php echo urlencode($rs["email_id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a> </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="3" align="left">No subscribers in the database</td>
        </tr>
    <?php } ?>
</table>
<?php
include("footer.php");
?>