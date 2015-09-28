<?php

file_put_contents('../../data/osdc-duplicates.json', json_encode($_GET)."\n", FILE_APPEND);

mail('ben@example.com', 'AGM duplicate', json_encode($_POST));

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Open Source Developers' Club - Special Resolution</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="/assets/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body class="privasi">
    <div class="container">

        <h1>OSDC Special Resolution Proxy Nomination</h1>
        <p>Thanks for reporting a duplicate email address. Don't forget to vote with the other email address now!

        <div class="footer">
            <div class="container-narrow">
                <div class="row">
                    <div class="col-md-12">
                        <p>This site is hosted by priva.si. There is no web server logging. The secure certificate and associated web server configuration uses the latest, highest standards.</p>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- /container -->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>

</body>
</html>

