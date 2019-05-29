<?php
$fb_login = new Facebook\Facebook([
    'app_id' => '2040535216240224',
    'app_secret' => 'a859caed0cf83cc96ad880d0a8832668',
    'default_graph_version' => 'v3.2',
]);

$helper = $fb_login->getRedirectLoginHelper();

$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('https://rabbit-llc.com/Timeline/fb-callback.php', $permissions);