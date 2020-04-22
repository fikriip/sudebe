<?php
print "[SUDEBE ACCOUNT CREATE]
	Erwin Alam
	\n";

$ref = readline("Masukin Code Reff lu sob : ");

$x = 1;
if(isset($argv[1])) {
    if(file_exists($argv[1])) {
        $ambil = explode(PHP_EOL, file_get_contents($argv[1]));
        foreach($ambil as $email) {
            $api = file_get_contents("https://api.namefake.com/indonesian-indonesia");
			$data = json_decode($api, 1);
			$nama = explode(" ", $data['name']);
			$namad = $nama[0];
			$namab = $nama[1];
			$dob = explode("-", $data['birth_data']);
			$thn = $dob[0];
			$bln = $dob[1];
			$tgl = $dob[2];
			$username = $data['username'];
			$useragent = $data['useragent'];
			cret($namad,$namab,$username,$email,$bln,$tgl,$thn,$useragent,$ref);
			$x++;
        }
    }else die("File doesn't exist!");
}else die("Usage: php cek.php list.txt");

function cret($namad,$namab,$username,$email,$bln,$tgl,$thn,$useragent,$ref){
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://www.sudebe.com/includes/ajax/core/signup.php');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "first_name=".$namab."&last_name=".$namab."&username=".$username."&email=".$email."&password=esemeh901&gender=male&birth_month=".$bln."&birth_day=".$tgl."&birth_year=".$thn."&newsletter_agree=on&privacy_agree=on");
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

	$headers = array();
	$headers[] = 'Host: www.sudebe.com';
	$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
	$headers[] = 'X-Requested-With: XMLHttpRequest';
	$headers[] = 'User-Agent:'.$useragent;
	$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
	$headers[] = 'Origin: https://www.sudebe.com';
	$headers[] = 'Sec-Fetch-Site: same-origin';
	$headers[] = 'Sec-Fetch-Mode: cors';
	$headers[] = 'Sec-Fetch-Dest: empty';
	$headers[] = 'Referer: https://www.sudebe.com/signup';
	$headers[] = 'Accept-Language: en-US,en;q=0.9';
	$headers[] = 'Cookie: PHPSESSID=1e54a988e6b983d37cb4c77c989ddd36; ref='.$ref.'; _ga=GA1.2.1608076446.1587524695; _gid=GA1.2.1980089888.1587524704; _gat_gtag_UA_155121126_1=1';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$result = json_decode(curl_exec($ch));
	if ($result->callback == "window.location.reload();") {
		echo $email." --> Success".PHP_EOL;
	} else {
		echo $email." --> Gagal".PHP_EOL;
	}
	
}