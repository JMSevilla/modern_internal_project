<?php
class Tokenization
{
    function tokenConfiguration(
        $callback,
        $token,
        $tokenName,
        $isSecure,
        $isHttpOnly,
        $expires,
        $path
    ) {
        if ($callback == "setter") {
            $argsCookie = array(
                'expires' => $expires,
                'path' => $path,
                'secure' => $isSecure,
                'httponly' => $isHttpOnly,
                'samesite' => 'None'
            );
            $this->cookieSetter($tokenName, $token, $argsCookie);
        }
    }
    public function cookieSetter($tn, $ot, $ac)
    {
        return setcookie($tn, $ot, $ac);
    }
    public function scanToken($request, $cookieData)
    {
        if (isset($request) == true) {
            if (isset($cookieData)) {
                echo json_encode(
                    (object)[0 => array("key" => "admin_exist_token")],
                    JSON_FORCE_OBJECT
                );
            } else {
                echo json_encode(
                    (object)[0 => array("key" => "not_exist")],
                    JSON_FORCE_OBJECT
                );
            }
        }
    }
}

if (isset($_POST['requestToken']) == true) {
    $toke = new Tokenization();
    if (!isset($_COOKIE['TA'])) {
        echo json_encode(
            (object)[0 => array("key" => "not_exist")],
            JSON_FORCE_OBJECT
        );
    } else {
        $toke->scanToken($_POST['requestToken'], $_COOKIE['TA']);
    }
}
