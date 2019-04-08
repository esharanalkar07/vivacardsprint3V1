<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebook https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */


require("../libs/config.php");

$msg = '';
if (isset($_POST["mode"])) {
    $allowed_ext = array("png", "jpg", "jpeg", "gif", "bmp");
    $card_id = db_prepare_input($_POST["card_id"]);
    $card_title = db_prepare_input($_POST["card_title"]);
    $filePath = db_prepare_input($_POST["card_url_hidden"]);
    $card_file = $_FILES["card_file"]["name"];

    if ($card_title == "") {
        $msg = errorMessage("Enter mandatory fields");
    } else {

        if ($card_file <> "") {
            $ext = end(explode(".", strtolower($card_file)));
            $ext = strtolower(pathinfo($card_file, PATHINFO_EXTENSION));
            $tempPath = "cards/" . time() . '_' . rand(100, 10000) . '.' . $ext;
            if (in_array($ext, $allowed_ext)) {
                if (@move_uploaded_file($_FILES["card_file"]["tmp_name"], "../" . $tempPath)) {

                    // delete old file
                    if (is_file("../" . $filePath)) {
                        @unlink("../" . $filePath);
                    }

                    $filePath = $tempPath;
                } else {
                    $msg = errorMessage("Error in uploading card! Please try again.");
                }
            } else {
                $msg = errorMessage("File type not supported");
            }
        }


        // if all data seems valid		
        if ($msg == "") {

            $sql = "UPDATE `" . TABLE_CARDS . "` SET `card_title` = :ct , `card_url` = :curl "
                    . "WHERE card_id = :cid";


            try {
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":ct", $card_title);
                $stmt->bindValue(":curl", $filePath);
                $stmt->bindValue(":cid", $card_id);

                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $msg = successMessage("Card updated Successfully");
                } else if ($stmt->rowCount() == 0) {
                    $msg = successMessage("No changes affected");
                } else {
                    $msg = errorMessage("failed to update Card.");
                }
            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }
        }
    }
}

$card_id = intval(db_prepare_input($_GET["edit"]));
$sql = "SELECT * FROM " . TABLE_CARDS . " WHERE 1 AND card_id = :id";
try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":id", $card_id);
    $stmt->execute();
    $card = $stmt->fetchAll();
} catch (Exception $ex) {
    echo errorMessage($ex->getMessage());
}

$pageTitle = "Edit Card";
include("header.php");
?>   
<?php echo $msg; ?>
<div class="formField">      
    <form method="post" action="" name="f" enctype="multipart/form-data" >
        <input type="hidden" name="mode" value="update" />
        <input type="hidden" name="card_id" value="<?php echo $card_id; ?>" />
        <input type="hidden" name="card_url_hidden" value="<?php echo $card[0]["card_url"]; ?>" />
        <table id="tableForm">
            <tr>
                <td class="formLeft"><span class="required">*</span>Title: </td>
                <td><input type="text" name="card_title" id="card_title" class="textboxes" value="<?php echo $card[0]["card_title"]; ?>" autocomplete="off" /> </td>
            </tr>

            <tr>
                <td class="formLeft">Upload Card: </td>
                <td><input type="file" name="card_file" id="card_file" />
                    <br>
                    <a style="margin-top: 5px;" href="../<?php echo stripslashes($card[0]["card_url"]); ?>" target="_blank" title="click to see large image">
                        <img src="../<?php echo stripslashes($card[0]["card_url"]); ?>" alt="" height="50" width="50" />
                    </a>

                </td>
            </tr>

            <tr>
                <td></td>
                <td> <input type="submit" name="sub" value="Save" /> &nbsp;  <input type="button" name="" onclick="javascript:window.location = 'manage_cards.php';" value="show listing" /> </td>
            </tr>       
        </table>
    </form>
</div>

<?php
include("footer.php");
?>