<?php
require "Autoload.php";

$fb = new Facebook\Facebook([
    'app_id' => '2040535216240224',
    'app_secret' => 'a859caed0cf83cc96ad880d0a8832668',
    'default_graph_version' => 'v3.3',
]);

$helper = $fb->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (! isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

$oAuth2Client = $fb->getOAuth2Client();

$tokenMetadata = $oAuth2Client->debugToken($accessToken);

$tokenMetadata->validateAppId('2040535216240224');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
    try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
        exit;
    }

    echo '<h3>Long-lived</h3>';
    var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

$fb = new Facebook\Facebook([
    'app_id' => '2040535216240224',
    'app_secret' => 'a859caed0cf83cc96ad880d0a8832668',
    'default_graph_version' => 'v3.3',
]);

try {
    $response = $fb->get('/me?fields=id,name,email,picture.height(400)', $_SESSION['fb_access_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$user = $response->getGraphUser();

$newUser = UserController::getByUsername($user->getId(), null, false);

if (!$newUser) {
    $userArr['_name'] = $user->getName();
    $userArr['_bio'] = '';
    $userArr['_username'] = $user->getId();
    $userArr['_email'] = $user->getEmail();
    $userArr['password'] = $user->getId();

    $fileArr['image'] = $user->getPicture()->getUrl();

    UserController::createUser($userArr, $fileArr, false);

    $newUser = UserController::getByUsername($user->getId(), null, false);
}

Session::Add('user', $newUser);
Timeline::redirectAbs('index');