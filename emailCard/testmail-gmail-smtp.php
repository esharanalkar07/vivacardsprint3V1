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
    $message .= '<tr><td><br><br><hr>This mail is send by Group E members and is used for demo purpose only. <b>Please do not reply.</b></td></tr>';

    $message .= "</table>";
    $message .= "</body></html>";


    require_once 'PHPMailer/class.phpmailer.php';
    $mail = new PHPMailer(true); 
    // telling the class to use SMTP
    $mail->IsSMTP(); 

    try {

        $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port = 465;                   // set the SMTP port for the GMAIL server

        $mail->Username = 'cloud.surrey@gmail.com';  // GMAIL username
        $mail->Password = 'P@$$w0rdUS!';            // GMAIL password must be in single quotes
        // sent from
        $mail->SetFrom($mail->Username, 'Group E Members');

        // send to
        $mail->AddAddress($email_id);

        $mail->Subject = $subject . ' Demo Test Email  ';

        $mail->MsgHTML($message);
        $mail->AddAttachment($ecard);      // attachment

        $mail->Send();
        
    } catch (phpmailerException $e) {
        #echo $e->errorMessage(); //Pretty error messages from PHPMailer
        simple_redirect("testmail-gmail-smtp.php?msg=error");
    } catch (Exception $e) {
        #echo $e->getMessage(); //Boring error messages from anything else!
        simple_redirect("testmail-gmail-smtp.php?msg=error");
    }
    //simple_redirect("testmail.php?msg=success");
    simple_redirect("testmail-gmail-smtp.php?msg=success");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Send greetings cards via email using php and mysql">
        <meta name="keywords" content="Send greetings cards via email using php and mysql">
        <link rel="stylesheet" href="emailCard/css/style.css">
        <link rel="stylesheet" href="emailCard/css/card.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="emailCard/css/colours.css">
        <meta name="author" content="Shahrukh Khan">
        <title>Send ebusiness cards via email</title>
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
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="active navbar-brand" href="index.php">VIVA CARD</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="dashboard.php">Home</a></li>
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
                <div class="mainTitle" ></div>
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
                    <table style="width:100%">
                        <tr>
                            <td align="left"><h4><a style="border-style: groove" href="index.php">Back to home page</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a style="border-style: groove" href="testmail.php">Send from Live Server</a></h4></td>
                            <td align="right"><h4><a style="border-style: groove"href="manage-cards/" target="_blank">Manage Contacts</a></h4></td>
                        </tr>
                    </table>
                    <div class="height10"></div>
                    <table style="width:100%"border="10">
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
