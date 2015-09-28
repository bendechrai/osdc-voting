<html>
<body>
<h1>OSDC 2015 Proxy Details</h1>
<?php

// Load members
$members = json_decode(file_get_contents('../../data/osdc-members.json'), true);

// Extract tokens
$valid_tokens = [];
foreach( $members as $member ) {
	$token = $member['token'];
	$valid_tokens[$token] = 1;
}

// Read all submissions
$lines = explode("\n", file_get_contents('../../data/osdc-votes.json'));

// Reverse lines, so we use the most recent of any votes
$lines = array_reverse($lines);

// Remember tokens, so we only count votes once
$tokens = [];

// Preseed proxies for sorting
$proxies = [
	'Ben Dechrai' => [],
	'Arjen Lentz' => [],
	'Jacinta Richardson' => [],
	'Katie McLaughlin' => [],
];

// Loop through each line in the results
foreach($lines as $line) {

	// Ignore blanks
	if(trim($line)=='') continue;

	// Extract data
	$member = json_decode($line, true);
	$token = $member['token'];
	$vote = ucfirst($member['vote']);
	$fullname = trim($member['fullname']);
	$proxy = $member['proxy'];
	$comment = trim($member['comment']);

	// If token not valid, skip vote
	if(!isset($valid_tokens[$token])) continue;

	// If "other" proxy, get name from comments box.
	if($proxy == 'Other (state in comment box - must be a current member)') $proxy = $comment;

	// If no proxy, ignore vote
	if (trim($proxy) == '') continue;

	// If no name, ignore vote
	if (trim($fullname) == '') continue;

	// If token used already, skip vote
	if(isset($tokens[$token])) continue;

	// Remember tokens, so we only count votes once
	$tokens[$token] = 1;

	// Make sure array structure exists
	if(!isset($proxies[$proxy])) $proxies[$proxy] = [];
	if(!isset($proxies[$proxy][$vote])) $proxies[$proxy][$vote] = [];

	// Register vote
	$proxies[$proxy][$vote][] = $fullname;

}

$vote_totals = [];

// Loop through all nominations
foreach($proxies as $proxy=>$votes) {

	// Echo proxy's name
	echo "<h2>$proxy</h2>";

	// Loop through all votes
	foreach($votes as $vote=>$voters) {

		// Preseed vote counter for this vote label
		if(!isset($vote_totals[$vote])) $vote_totals[$vote] = 0;

		// Echo vote label
		echo "<h3>$vote</h3>";

		// Sort voters for prettyness
		sort($voters);

		// Loop through all voters for this vote label for this proxy
		echo "<ul>";
		foreach($voters as $voter) {

			// Echo proxee's name, and count their vote in the totals
			echo "<li>$voter</li>";
			++$vote_totals[$vote];
		}
		echo "</ul>";
	}

}

// Print vote totals
echo "<h2>Totals</h2>";
$total = 0;
foreach($vote_totals as $vote=>$count) {
	echo "<p><strong>$vote</strong> $count</p>";
	$total += $count;
}
echo "<p><strong>Total Votes:</strong> $total</p>";
?>
</body>
</html>
