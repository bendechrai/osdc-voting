<?php

file_put_contents('../../data/osdc-votes.json', json_encode($_POST)."\n", FILE_APPEND);

mail('ben@example.com', 'AGM vote', json_encode($_POST));

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
        <p>Thanks for your proxy nomination. If you change your mind on vote or proxy, please just complete the form again by following the link in the email you receoved from us.</p>
        <p>If you turn up to the AGM, please advice the chairperson so that your proxy is not counted.</p>

        <p>Your submission:</p>
        <dl>
          <dt>Vote</dt>
          <dd><?=htmlspecialchars($_POST['vote'])?></dd>
          <dt>Your full name</dt>
          <dd><?=htmlspecialchars($_POST['fullname'])?></dd>
          <dt>Your proxy nomination</dt>
          <dd><?=htmlspecialchars($_POST['proxy'])?></dd>
          <dt>Additional comments, inclusing proxy name if "Other" selected</dt>
          <dd><?=htmlspecialchars($_POST['comment'])?></dd>
        </dl>

        <hr>

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

