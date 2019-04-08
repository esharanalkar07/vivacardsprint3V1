<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebook https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */

require("libs/config.php");
if (isset($_POST["mode"]) && $_POST["mode"] == "send") {
    $email_id = db_prepare_input($_POST["email_id"]);
    $subject = db_prepare_input($_POST["subject"]);
    $ecard = db_prepare_input($_POST["ecard"]);
    $msg = db_prepare_input($_POST["msg"]);

    $message = '<html><body>';
    $message .= '';
    $message .= '<table rules="all" width="600px" style="border-color: #666;" cellpadding="10">';
    //$message .= '<tr style="background: #eee;"><td><h1><a href="http://www.thesoftwareguy.in/" target="_blank"><img src="http://www.thesoftwareguy.in/thesoftwareguy-logo-small.png" alt="thesfotwareguy programming blog" /></a></h1></td></tr>';
    $message .= "<tr style='background: #eee;'><td>" . $msg . "</td></tr>";
    $message .= "</table>";
    $message .= '<table rules="all" width="600px">';
    $message .= '<tr><td><br><br><hr>This mail is sent by Group E members and is used for demo purpose only. <b>Please do not reply.</b></td></tr>';

    $message .= "</table>";
    $message .= "</body></html>";
    
    require_once 'PHPMailer/class.phpmailer.php';
    //defaults to using php "mail()"; 
    //the true param means it will throw exceptions on errors, which we need to catch
    $mail = new PHPMailer(true); 

    try {
        
         // add your email address and name
        $mail->SetFrom('1712499@rgu.ac.uk', 'Kuanyin Malang');

        $mail->AddAddress("kakech@outlook.com");

        $mail->Subject = $subject . ' Test Card Sending ';

        $mail->MsgHTML($message);
        $mail->AddAttachment($ecard);      // attachment

        $mail->Send();
        simple_redirect("testmail.php?msg=success");
    } catch (phpmailerException $e) {
        #echo $e->errorMessage(); //Pretty error messages from PHPMailer
        simple_redirect("testmail.php?msg=error");
    } catch (Exception $e) {
        #echo $e->getMessage(); //Boring error messages from anything else!
        simple_redirect("testmail.php?msg=error");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" href="http://www.thesoftwareguy.in/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Send greetings cards via email using php and mysql">
        <meta name="keywords" content="Send greetings cards via email using php and mysql">
        <meta name="author" content="Shahrukh Khan">
        <title>Send ebusiness card via email</title>
        <link rel="stylesheet" href="style.css" type="text/css" />

        <link rel="stylesheet" type="text/css" href="CLEditor/jquery.cleditor.css" />
        <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="CLEditor/jquery.cleditor.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#msg").cleditor({width: 450, height: 200});

            });

            function cardPreview(sel) {
                var card_url = sel.options[sel.selectedIndex].value;
                if (card_url != "") {
                    var str = '<a href="' + card_url + '" target="_blank" title="click too see larger image"><img src="' + card_url + '" alt=""  /></a>';
                    $("#card").html(str);
                } else {
                    $("#card").html("");
                }
            }

            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }

            function validateForm() {
                var subject = $.trim($("#subject").val());
                var email_id = $.trim($("#email_id").val());
                var ecard = $.trim($("#ecard").val());
                var msg = $.trim($("#msg").val());

                if (email_id == "") {
                    alert("Enter your email");
                    $("#email_id").focus();
                    return false;
                } else if (!IsEmail(email_id)) {
                    alert("Enter valid email");
                    $("#email_id").focus();
                    return false;
                }

                if (subject == "") {
                    $("#subject").focus();
                    alert("Enter subject line.");
                    return false;
                } else if (subject.length <= 4) {
                    $("#subject").focus();
                    alert("Subject line must be atleast 5 character.");
                    return false;
                }

                if (ecard == "") {
                    alert("Select a card to send.");
                    $("#ecard").focus();
                    return false;
                }

                if (msg == "") {
                    $("#msg").focus();
                    alert("Enter Message.");
                    return false;
                } else if (msg.length <= 9) {
                    $("#msg").focus();
                    alert("Message must be atleast 10 character.");
                    return false;
                }

                return true;
            }

        </script>
    </head>
    <body>
        <div id="container">
            <div id="body"> 	
                <div class="mainTitle" >Send ebusiness card via email</div>
                <div class="height10"></div>
                <div class="height10"></div>
                <article>
                    <?php
                    if ($_GET["msg"] == "success") {
                        echo successMessage("Card has been send successfully");
                    } elseif ($_GET["msg"] == "error") {
                        echo errorMessage("There was some problem sending mail");
                    }
                    ?>
                    <table style="width:100%" border="0">
                        <tr>
                            <td align="left"><h2><a href="index.php">Back to home page</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a href="testmail-gmail-smtp.php">Send using gmail(smtp)</a></h2></td>
                       <td align="right"><h2><a href="manage-cards/" target="_blank">Manage Contacts</a></h2></td>
                        </tr>
                    </table>
                    <div class="height10"></div>
                    <table style="width:100%" border="1">
                        <tr>
                            <td width="55%">
                                <form action="" method="post" name="f" onSubmit="return validateForm();">
                                    <input type="hidden" name="mode" value="send" />
                                    <table style="width:100%" cellpadding="4" >

                                        <tr>
                                            <td>Email: </td>
                                            <td>
                                                <input type="text" name="email_id" value="" id="email_id" class="textboxes" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Subject: </td>
                                            <td>
                                                <input type="text" name="subject" value="" id="subject" class="textboxes" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Select Card: </td>
                                            <td>
                                                <?php
                                                $sql = "SELECT * FROM " . TABLE_CARDS . " WHERE 1 ORDER BY card_id ASC";
                                                try {
                                                    $stmt = $DB->prepare($sql);
                                                    $stmt->execute();
                                                    $cardsResults = $stmt->fetchAll();
                                                } catch (Exception $ex) {
                                                    echo errorMessage($ex->getMessage());
                                                }
                                                ?>
                                                <select class="textboxes" name="ecard" id="ecard" onChange="cardPreview(this);">
                                                    <option value="">select</option>
                                                    <?php
                                                    
                                                    foreach ($cardsResults as $rs) {
                                                        ?>
                                                        <option value="<?php echo stripslashes($rs["card_url"]); ?>"><?php echo stripslashes($rs["card_title"]); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="top">Message: </td>
                                            <td>
                                                <textarea name="msg" id="msg" style="width:400px;"></textarea>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="top"> </td>
                                            <td valign="top"><input type="submit" name="s" value="send"> </td>
                                        </tr>

                                    </table>
                                </form>
                            </td>
                            <td valign="top">
                                <h3 style="text-align:center;">E-Business Card Preview</h3>
                                <div id="card" style="max-width:435px; max-height:280px; overflow:hidden; margin:0 auto;"></div>
                            </td>
                        </tr>
                    </table>	  
                </article>
                <div class="height10"></div>
                <footer>
                    <div class="copyright"> &copy; 2019- Group E. All rights reserved </div>
                </footer>
            </div>
        </div>
    </body>
</html>
