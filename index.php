<!DOCTYPE html>
<html lang="en">
<head>

       <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>VIVA Card</title>
    <link rel="stylesheet" href="assets/css/colours.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


</head>

<body>
<div class="container-fluid">

    <!--- Header --->
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="active navbar-brand" href="index.php">VIVA CARD</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
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
    <!--- Header End--->
    <!---Returning user & New user--->
    <div class="row container-fluid text-center">

        <div class="col-sm-6">
            <center>
                <div>
                    <a href="#">
                        <img  class="img-responsive" src="assets/Images/login.png" class="img-thumbnail img-responsive" width="150px" height="100px"
                              alt="Returning user">
                        <div class="caption">
                            <p><a href="login.php">Returning User</a</p>
                        </div>
                    </a>
                </div></center>
        </div>
        <div class="col-sm-6">
            <center>
                <div>
                    <a href="#">
                        <img class="img-responsive" src="assets/Images/user.png" class="img-thumbnail img-responsive" width="150px" height="100px" alt="New user">
                        <div class="caption">
                            <p><a href="register.php">New User</a</p>
                        </div>
                    </a>
                </div></center>
        </div>

    </div>
</div>
<!---Returning user & New user End--->

<!---Services start--->
<div class="container-fluid text-center">
    <h4>Services</h4>
    <h6>What Viva Card offers</h6>
    <main class ="col-md-12">
        <div class="row text-center">
            <article class="col-md-3">
                <div class = "thumbnail">
                    <img src="assets/Images/cardmanagement.jpg" class="img-thumbnail img-responsive" alt="card">
                    <p><strong>Card Management</strong></p>
                    <p>Have piles of business or social cards to go through before getting to a specific one? Not anymore!</p>

                </div>
            </article>

            <article class="col-md-3">
                <div id="firstarticle">
                    <div class = "thumbnail">
                        <img src="assets/Images/smartcard.png" class="img-thumbnail" alt="card">
                        <p><strong>Smart Cards</strong></p>
                        <p>Traditional business cards but all on one device! Share your business cards by scanning.</p>
                    </div>
                </div>
            </article>

            <article class="col-md-3">
                <div id="second article">
                    <div class = "thumbnail">
                        <img src="assets/Images/people.jpg" class="img-thumbnail" alt="card">
                        <p><strong>Real Time Contact</strong></p>
                        <p>Easily get your contact card list updated when your contact changes information.                       </p>
                    </div>
                </div>
            </article>

            <article class="col-md-3">
                <div class = "thumbnail">
                    <img src="assets/Images/meeting.jpg" class="img-thumbnail" alt="card">
                    <p><strong>Multiservice & Flexibility</strong></p>
                    <p>Social or Professional use? why not both?</p>
                </div>
            </article>

        </div>
    </main>
</div>
</div>
<!---Services end--->
</body>
<!---Footer start--->
<div class="container-fluid text-center">
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
                            <img src="/assets/Images/email.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                        <a href="#">
                            <img src="/assets/Images/facebook.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                        <a href="#">
                            <img src="/assets/Images/twitter.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>
                        <a href="#">
                            <img src="/assets/Images/github.png" class="img-thumbnail img-responsive" width="30px" height="20px"></a>

                    </center> </h6>
            </address>
        </div>
    </footer>
</div>
<!---Footer end--->
</body>
</html>
