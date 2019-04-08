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

    $email_id = db_prepare_input($_POST["email_id"]);
    $status = db_prepare_input($_POST["status"]);

    if ($email_id == "") {
        $msg = errorMessage("Enter mandatory fields");
    } else {

        $sql = "INSERT INTO `" . TABLE_SUBSCRIBERS . "` ( `email_id` , `status` ) VALUES ( :em, :st )";
        
        try {
            $stmt = $DB->prepare($sql);
            $stmt->bindValue(":em", $email_id);
            $stmt->bindValue(":st", $status);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $msg = successMessage("Subscriber Added successfully.");
            } else if ($stmt->rowCount() == 0) {
                $msg = successMessage("No changes affected");
            } else {
                $msg = errorMessage("failed to add Subscriber.");
            }
        } catch (Exception $ex) {
            echo errorMessage($ex->getMessage());
        }

    }
}

$pageTitle = "Add New Subscriber";
include("header.php");
?>

<script>
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function validateForm() {
        var email = document.getElementById("email_id").value;
        email = email.trim();
        if (email == "") {
            alert("Enter your email");
            document.getElementById("email_id").focus();
            return false;
        } else if (!IsEmail(email)) {
            alert("Enter valid email");
            document.getElementById("email_id").focus();
            return false;
        }
        return true;
       
    }
</script>
<?php echo $msg; ?>
<div class="formField">      
    <form method="post" action="" name="subscriber" onsubmit="return validateForm();">
        <input type="hidden" name="mode" value="add" />
        <table id="tableForm">
            <tr>
                <td class="formLeft"><span class="required">*</span>Email Id: </td>
                <td><input type="text" name="email_id" id="email_id" class="textboxes" value="" autocomplete="off" /> </td>
            </tr>

            <tr>
                <td class="formLeft">Status: </td>
                <td><input type="checkbox" name="status" id="status" value="A" checked="checked" /> Active</td>
            </tr>

            <tr>
                <td></td>
                <td> <input type="submit" name="sub" value="Save" /> &nbsp;  <input type="button" name="" onclick="javascript:window.location = 'manage_subscribers.php';" value="show listing" /> </td>
            </tr>       
        </table>
    </form>
</div>

<?php
include("footer.php");
?>