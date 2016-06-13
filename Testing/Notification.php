
<?php
$app_id = '696804930432071';
$app_secret = '7e8e1856e36c9e54f57fb7f2f29ecb96';
$user_id = '830114517036152';
$token_url = 'https://graph.facebook.com/oauth/access_token?' .
'client_id=' . $app_id .
'&client_secret=' . $app_secret .
'&grant_type=client_credentials';

$app_access_token = file_get_contents($token_url);

$postdata = http_build_query(
array(
'href' => 'index.php',
'template' => 'Your notification message',
'ref' => 'ref'
)
);

$opts = array('http' =>
array(
'method'  => 'POST',
'header'  => 'Content-type: application/x-www-form-urlencoded',
'content' => $postdata
)
);

$context  = stream_context_create($opts);
$result = file_get_contents('https://graph.facebook.com/'. $user_id . '/notifications?' . $app_access_token, false, $context);

echo $result;
?>