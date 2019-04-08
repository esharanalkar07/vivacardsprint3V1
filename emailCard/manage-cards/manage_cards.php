<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebook https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */


require("../libs/config.php");
$pageTitle = "Manage Ecards";
$msg = '';
if (isset($_GET["del"]) && $_GET["del"] != "") {
    $card_id = intval(db_prepare_input($_GET["del"]));

    $sql = "SELECT * FROM " . TABLE_CARDS . " WHERE 1 AND card_id = :id ORDER BY card_id ASC";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":id", $card_id);
        $stmt->execute();
        $card = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }


    $sql = "DELETE FROM  " . TABLE_CARDS . " WHERE `card_id` = :cid";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":cid", $card_id);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            // only if the card is deleted from database 
            $filePath = "../" . $card[0]["card_url"];
            if (is_file($filePath)) {
                @unlink($filePath);
            }

            $msg = successMessage("Subscriber deleted successfully.");
        } else if ($stmt->rowCount() == 0) {
            $msg = successMessage("No changes affected");
        } else {
            $msg = errorMessage("failed to delete card.");
        }
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }
}
include("header.php");
?>   
<?php echo $msg; ?>
<div class="title" style="text-align:right;"><a href="add_cards.php">Add New Card</a></div>
<table class="bordered">
    <tr>
        <th ><strong>Title</strong> </th>
        <th><strong>Card</strong> </th>
        <th><strong>Action</strong> </th>
    </tr>
    <?php
    $sql = "SELECT * FROM " . TABLE_CARDS . " WHERE 1 ORDER BY card_id ASC";

    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $cardsResults = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }

    if (count($cardsResults) > 0) {

        foreach ($cardsResults as $rs) {
            ?>
            <tr>
                <td ><?php echo stripslashes($rs["card_title"]); ?></td>
                <td>
                    <a href="../<?php echo stripslashes($rs["card_url"]); ?>" target="_blank">
                        <img src="../<?php echo stripslashes($rs["card_url"]); ?>" alt="" height="50" width="50" />
                    </a>
                </td>
                <td>
                    <a href="edit_cards.php?edit=<?php echo ($rs["card_id"]); ?>" >Edit</a> &nbsp;
                    <a href="manage_cards.php?del=<?php echo ($rs["card_id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a> </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="3" align="left">No cards in the database</td>
        </tr>
    <?php } ?>
</table>
<?php
include("footer.php");
?>