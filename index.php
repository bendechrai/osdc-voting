<?php

// Assume we know nothing
$email = '';
$token = '';

// If there's a token, get the email address
if(isset($_GET['token'])) {

    // Token should only have upperl lower and numbers
    $token = preg_replace('[^A-Za-z0-9]', '', $_GET['token']);

    // Do we still have a token?
    if($token !== '') {

        // Load members
        $members = json_decode(file_get_contents('../../data/osdc-members.json'), true);

        // Find member
        foreach( $members as $member ) {
            if( $member['token'] == $token ) {
                $email = $member['email'];
            }
        }

    }
}

// If no email set, send report to admin
if( $email == '' ) {
    mail('ben@example.com', 'OSDC Vote Error', 'Could not find email for token ' . $token);
}

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

        <?php if($email == ''): ?>

            <h2>Oops!</h2>
            <p>The link you followed is missing a token, so we can't tell who you are. Please follow the link as given in the email you received. If you continue to experience issues, please reply to the email and let us know.</p>

        <?php else : ?>

            <p>You are nominating a proxy for your vote in the upcoming special resolution for the closing of the Open Source Developers' Club, Inc. Your proxy will vote for you on this matter during the AGM to be held at 18:00 on Wednesday the 28th October, 2015 at Wrest Point, Hobart, during the Open Source Developers' Conference.</p>

            <form action="vote.php" method="post" class="form">
                <input type="hidden" name="token" value="<?=preg_replace('#[^A-Za-z0-9]#', '', $_GET['token'])?>" />
                <div class="row vote">
                    <div class="col-md-12">
                        <label>MOTION: To pass a special resolution to close the organisation, and assign any remaining assets to Linux Australia.</label>
                        <p>If you vote no, please be prepared to stand for a committee position.</p>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary yes<?php if($_GET['vote']=='yes') echo ' active' ?>">
                                <input type="radio" name="vote" value="yes" id="yes"<?php if($_GET['vote']=='yes') echo ' checked="checked"' ?> autocomplete="off">Yes
                            </label>
                            <label class="btn btn-primary no<?php if($_GET['vote']=='no') echo ' active' ?>">
                                <input type="radio" name="vote" value="no" id="no"<?php if($_GET['vote']=='no') echo ' checked="checked"' ?> autocomplete="off">No
                            </label>
                        </div>
                        <label class="abstain">
                            <input type="radio" name="vote" value="abstain" id="abstain"<?php if($_GET['vote']=='abstain') echo ' checked="checked"' ?> autocomplete="off">I wish to abstain
                        </label> 
                    </div>
                </div>
                <div class="row fullname">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullname">Full Name (required to validate vote)</label>
                            <span>More detail below</span>
                            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="" required="text"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="proxy">Person you wish to nominate as your proxy</label>
                            <select class="form-control" name="proxy">
                                <option>Ben Dechrai</option>
                                <option>Arjen Lentz</option>
                                <option>Jacinta Richardson</option>
                                <option>Katie McLaughlin</option>
                                <option>Other (state in comment box - must be a current member)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row email">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email address (per membership list)</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?=htmlspecialchars($email)?>" disabled="disabled" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="comment">Comments or special requests of your proxy (optional)</label>
                            <input type="text" class="form-control" name="comment" id="comment" value="" />
                        </div>
                    </div>
                </div>
                <input type="submit" class="col-sm-12 btn btn-success" name="action" value="Save Proxy Vote Nomination!"/>
            </form>

        <?php endif; ?>

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

