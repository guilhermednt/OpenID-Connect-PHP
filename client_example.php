<?php

/**
 *
 * Copyright MITRE 2012
 *
 * OpenIDConnectClient for PHP5
 * Author: Michael Jett <mjett@mitre.org>
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 */

require "vendor/autoload.php";

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

$clientId = 'ID';
$clientSecret = 'SECRET';

$session = new Session(new NativeSessionStorage());
$oidc = new OpenIDConnectClient(
    'https://your.provider',
    $clientId, $clientSecret,
    $session
);
$oidc->setClientName('OIDC Demo');
$oidc->setRedirectURL('http://localhost:8080/');

if ($clientId === null) {
    $oidc->register(
        [
            'logo_uri' => "https://placehold.it/300/ffa500/000000?text=LOGO",
        ]
    );
    var_dump($oidc);
    die();
}

$oidc->authenticate();
$name = $oidc->requestUserInfo('given_name');

?>

<html>
<head>
    <title>Example OpenID Connect Client Use</title>
    <style>
        body {
            font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
        }
    </style>
</head>
<body>

<div>
    Hello <?php echo $name; ?>
</div>

</body>
</html>

