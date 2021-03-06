<?php
//==============================================================
//Please change following variables.
//--------------------------------------------------------------

//$bitly_usr = 'username';
//$bitly_key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
//==============================================================

//JavaScriptへ返す配列を準備
$result  = array();

//可変長オブジェクトを引数に採っている
foreach ($_GET as $url) {
	if (!is_string($url)) die();
	
	$req  = 'http://api.bit.ly/shorten?version=2.0.1';
	$req .= "&login=$bitly_usr";
	$req .= "&apiKey=$bitly_key";
	$req .= '&longUrl='.rawurlencode($url);

	$contents = file_get_contents($req);
	if(isset($contents)) {
		$bitly = json_decode($contents, true);
	}
	$result[] = $bitly['results'][$url]['shortUrl'];
}

echo json_encode($result);
?>
