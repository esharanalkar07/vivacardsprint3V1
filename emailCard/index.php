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
    $smode = db_prepare_input($_POST["smode"]);
    $subject = db_prepare_input($_POST["subject"]);
    $ecard = db_prepare_input($_POST["ecard"]);
    $msg = db_prepare_input($_POST["msg"]);
    $subscribers = $_POST["subscribers"];
    $emailArr = array();

    if ($smode == 2) {
        $s = " AND status = 'A' ";
    } else if ($smode == 3) {
        $s = " AND status = 'I' ";
    }

    if ($smode != 4) {
        $sql = "SELECT * FROM " . TABLE_SUBSCRIBERS . " WHERE 1 $s ORDER BY email_id ASC";
        try {
            $stmt = $DB->prepare($sql);
            $stmt->execute();
            $subResults = $stmt->fetchAll();
        } catch (Exception $ex) {
            echo errorMessage($ex->getMessage());
        }

        foreach ($subResults as $rs) {
            $emailArr[] = stripslashes(($rs["email_id"]));
        }

        $emails = implode(",", $emailArr);
    }

    if (is_array($subscribers) && count($subscribers) > 0) {
        $emailArr = $subscribers;
    }



    $message = '<html><body>';
    $message .= '';
    $message .= '<table style="border-color: #666;width:600px;" cellpadding="10">';
   // $message .= '<tr style="background: #eee;"><td><h1><a href="http://www.thesoftwareguy.in/" target="_blank"><img src="http://www.thesoftwareguy.in/thesoftwareguy-logo-small.png" alt="thesfotwareguy programming blog" /></a></h1></td></tr>';
    $message .= "<tr style='background: #eee;'><td>" . $msg . "</td></tr>";
    $message .= "</table>";
    $message .= '<table rules="all" width="600px">';
    $message .= '<tr><td><br><br><hr>This mail is send by Group E members and is used for demo purpose only. <b>Please do not reply.</b></td></tr>';

    $message .= "</table>";
    $message .= "</body></html>";


    require_once 'PHPMailer/class.phpmailer.php';
    // defaults to using php "mail()"; 
    // the true param means it will throw exceptions on errors, 
    // which we need to catch
    $mail = new PHPMailer(true);

    try {
        
        // add your email address and name
        $mail->SetFrom('esharanalkar7@gmail.com', 'Aishwarya');

        foreach ($emailArr as $email) {
            $mail->AddAddress($email);
        }

        $mail->Subject = $subject . ' Sharing my contacts';

        $mail->MsgHTML($message);
        $mail->AddAttachment($ecard);      // attachment

        $mail->Send();
        simple_redirect("index.php?msg=success");
    } catch (phpmailerException $e) {
        #echo $e->errorMessage(); //Pretty error messages from PHPMailer
        simple_redirect("index.php?msg=error");
    } catch (Exception $e) {
        #echo $e->getMessage(); //Boring error messages from anything else!
        simple_redirect("index.php?msg=success");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="emailCard/css/style.css">
        <link rel="stylesheet" href="emailCard/css/card.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="emailCard/css/colours.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Send ebusiness cards via email">
        <meta name="keywords" content="Send ebusiness cards via email">
        <meta name="author" content="Group E- 2019">
        <title>Send e-business cards via email </title>
        <link rel="stylesheet" href="style.css" type="text/css" />

        <link rel="stylesheet" type="text/css" href="CLEditor/jquery.cleditor.css" />
        <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="CLEditor/jquery.cleditor.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#msg").cleditor({width: 450, height: 200});

                // add multiple select / deselect functionality
                $("#all").click(function() {

                    var checkAll = $("#all").prop('checked');
                    if (checkAll) {
                        $(".subscheked").prop("checked", true);
                    } else {
                        $(".subscheked").prop("checked", false);
                    }

                });

                // if all checkbox are selected, check the selectall checkbox
                // and viceversa
                $(".subscheked").click(function() {

                    if ($(".subscheked").length == $(".subscheked:checked").length) {
                        $("#all").attr("checked", "checked");
                    } else {
                        $("#all").removeAttr("checked");
                    }

                });

            });

            function cardPreview(sel) {
                var card_url = sel.options[sel.selectedIndex].value;
                if (card_url != "") {
                    var str = '<a href="' + card_url + '" target="_blank" title="click too see larger image"><img src="' + card_url + '" alt="" width="435"  /></a>';
                    $("#card").html(str);
                } else {
                    $("#card").html("");
                }
            }

            function subscriberSelect(sel) {
                var v = sel.options[sel.selectedIndex].value;

                if (v == 4) {
                    $("#customUser").show();
                } else {
                    $("#customUser").hide();
                }

            }

            function validateForm() {
                var subject = $.trim($("#subject").val());
                var smode = $.trim($("#smode").val());
                var ecard = $.trim($("#ecard").val());
                var msg = $.trim($("#msg").val());

                if (smode == 4) {
                    if ($(".subscheked:checked").length < 1) {

                        alert("You must select atleast one email.");
                        return false;
                    }
                } else if (smode == "") {
                    alert("Select the subscriber to send.");
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
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="active navbar-brand" href="../index.php">VIVA CARD</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../dashboard.php">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
                <form class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

            </div>
        </nav>
    </header>
    <body>
        <div id="container">
            <div id="body"> 	

                 <article>
                    <?php
                    if ($_GET["msg"] == "success") {
                        echo successMessage("Card has been send successfully");
                    } elseif ($_GET["msg"] == "error") {
                        echo errorMessage("There was some problem sending mail");
                    }
                    ?>
                    <table style="width:100%" >
                        <tr>
                            <td align="left"><h4><a style="border-style: groove" href="testmail.php">Send from Live Server</a>&nbsp;&nbsp;&nbsp;&nbsp;<a style="border-style: groove" href="testmail-gmail-smtp.php"> Send from Localhost</a></h4></td>
                           <!-- <td align="right"><h3><a href="manage-cards/" target="_blank">Manage Your E-Business Card Contacts</a></h3></td> -->
                        </tr>
                    </table>
                    <div class="height10"></div>
                    <table style="width:100%" border=10">
                        <br>
                        <tr>
                            <td width="55%">
                                <form action="" method="post" name="f" onSubmit="return validateForm();">
                                    <input type="hidden" name="mode" value="send" />
                                    <table style="width:50%" cellpadding="4" >
                                        <tr>
                                            <td  valign="top">Send to: </td>
                                            <td>
                                                <select class="textboxes" name="smode" id="smode" onChange="subscriberSelect(this);">
                                                    <option value="">select contacts</option>
                                                    <option value="1">All contacts</option>
                                                    <option value="2">Active contacts only</option>
                                                    <option value="3">Inactive contacts only</option>
                                                    <option value="4">Custom select</option>
                                                </select>
                                                <br />
                                                <div id="customUser" style="width:280px; border:1px solid #000; margin-top:10px;height:200px; overflow:scroll;display:none; ">
                                                    <table cellpadding="4"  >
                                                        <tr style="background:#F7F7F7;">
                                                            <th valign="top" align="center" width="60px;"><input type="checkbox" name="all" id="all" value="1" /> </th>
                                                            <th valign="top" align="left">Email</th>
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

                                                        foreach ($subResults as $rs) {
                                                            ?>
                                                            <tr>
                                                                <td valign="top" align="center" width="60px;">
                                                                    <input type="checkbox" name="subscribers[]" class="subscheked" value="<?php echo stripslashes($rs["email_id"]); ?>" />
                                                                </td>
                                                                <td valign="top" align="left"><?php echo stripslashes($rs["email_id"]); ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </table>

                                                </div>

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
                                <h3 style="text-align:center;">Vivacard Preview</h3>
                                <div id="card" style="max-width:435px; max-height:280px; overflow:hidden; margin:0 auto;"></div>
                            </td>
                        </tr>
                    </table>	  
                </article>
                <div class="height10"></div>
                <footer class=“col-md-12">
                    <div class=‘row'>
                        <section class="col-md-2">
                            <a href="#"><h6>Meet the team</h6></a>
                        </section>
                        <section class="col-md-2">
                            <a href="#"><h6>Privacy</h6></a>
                        </section>
                        <section class="col-md-2">
                            <a href="#"><h6>Sitemap</h6></a>
                        </section>
                        <section class="col-md-2">
                            <a href="#"><h6>Complaints</h6></a>
                        </section>
                        <section class="col-md-2">
                            <a href="#"><h6>User Policy</h6></a>
                        </section>
                        <section class="col-md-2">
                            <address>
                                <a href="mailto:groupe_cmm004@live.rgu.ac.uk"><h6>Contact Information</h6></a>
                            </address>
                        </section>
                        <address>
                            <h6><center>Visit us at<br>
                                    Robert Gordon University, Garthdee House,<br>
                                    Garthdee Road, Aberdeen, AB10 7QB, Scotland,<br>
                                    UK<br>
                                    <a href="mailto:groupe_cmm004@live.rgu.ac.uk">
                                        <img src="assets/Images/email.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                                    <a href="#">
                                        <img src="assets/Images/facebook.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                                    <a href="#">
                                        <img src="assets/Images/twitter.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                                    <a href="#">
                                        <img src="assets/Images/github.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                                </center> </h6>
                        </address>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
