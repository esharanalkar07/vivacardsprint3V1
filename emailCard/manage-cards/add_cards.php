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

    $card_title = db_prepare_input($_POST["card_title"]);
    $card_file = $_FILES["card_file"]["name"];
    $allowed_ext = array("png", "jpg", "jpeg", "gif", "bmp");

    if ($card_title == "" || $card_file == "") {
        $msg = errorMessage("Enter mandatory fields");
    } else {
        
        $ext = strtolower(pathinfo($card_file, PATHINFO_EXTENSION));
        $filePath = "cards/" . time() . '_'. rand(100, 10000) .'.'.$ext;
        if (in_array($ext, $allowed_ext)) {
            if (@move_uploaded_file($_FILES["card_file"]["tmp_name"], "../" . $filePath)) {

                $sql = "INSERT INTO `" . TABLE_CARDS . "` ( `card_title` , `card_url` ) VALUES ( :ct, :curl)";

                try {
                    $stmt = $DB->prepare($sql);
                    $stmt->bindValue(":ct", $card_title);
                    $stmt->bindValue(":curl", $filePath);

                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        $msg = successMessage("Card Added Successfully");
                    } else if ($stmt->rowCount() == 0) {
                        $msg = successMessage("No changes affected");
                    } else {
                        $msg = errorMessage("failed to add Card.");
                    }
                } catch (Exception $ex) {
                    echo errorMessage($ex->getMessage());
                }


                
            } else {
                $msg = errorMessage("Error in uploading card! Please try again.");
            }
        } else {
            $msg = errorMessage("File type not supported");
        }
    }
}

$pageTitle = "Add New Card";
include("header.php");
?>   
<?php echo $msg; ?>
<div class="formField">      
    <form method="post" action="" name="f" enctype="multipart/form-data" >
        <input type="hidden" name="mode" value="add" />
        <table id="tableForm">
            <tr>
                <td class="formLeft"><span class="required">*</span>Title: </td>
                <td><input type="text" name="card_title" id="card_title" class="textboxes" value="<?php echo $card_title; ?>" autocomplete="off" /> </td>
            </tr>

            <tr>
                <td class="formLeft"><span class="required">*</span>Upload Card: </td>
                <td><input type="file" name="card_file" id="card_file" /> <br />
                    Only png, jpg, jpeg, gif, bmp supported </td>
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