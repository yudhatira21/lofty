<?php
include 'curl.php';

echo "Your Email : ";
$mail = trim(fgets(STDIN));

if ($mail != "") {

	while (true) {
		$date = date('Y-md');
		$tgl = explode('-', $date);
		$fake_name = curl('https://fakenametool.net/generator/random/id_ID/indonesia', null, null, false);
		preg_match_all('/<td>(.*?)<\/td>/s', $fake_name, $result);
		$name = $result[1][0];
		$secmail = curl('https://www.1secmail.com/api/v1/?action=getDomainList', null, null, false);
		$domain = json_decode($secmail);
		$rand = array_rand($domain);
		$email = str_replace(' ', '', strtolower($name)).'@gmail.com';

		$headers = array(
			'Host: api.getwaitlist.com',
			'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0',
			'Accept: application/json',
			'Referer: https://liquiditypool.lofty.ai/',
			'Content-Type: application/json',
			'Origin: https://liquiditypool.lofty.ai',
			'Connection: keep-alive',
			'Sec-Fetch-Dest: empty',
			'Sec-Fetch-Mode: cors',
			'Sec-Fetch-Site: cross-site',
			'TE: trailers'
		);

		$page = curl('https://api.getwaitlist.com/api/v1/waiter?email='.$mail.'&waitlist_id=5846', null, false, false);
		$json = json_decode($page, true);

		$post = curl('https://api.getwaitlist.com/api/v1/waiter', '{"waitlist_id":5846,"referral_link":"'.$json['referral_link'].'","heartbeat_uuid":"8eccbbf7-81ae-4a92-a248-bb76682c0370","widget_type":"WIDGET_1","email":"'.$email.'","answers":[]}', $headers, false);

		if (stripos($post, '"amount_referred"')) {
			echo 'Total Reff : '. $json['amount_referred']."\n";
		} else {
			echo "Failed\n";
		}
	} 

} else {
	echo "Cannot be blank\n";
}

