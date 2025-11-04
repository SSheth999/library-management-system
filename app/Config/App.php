<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public string $baseURL = 'http://localhost:8080/';

    public string $indexPage = 'index.php';

    public string $uriProtocol = 'REQUEST_URI';

    public bool $forceGlobalSecureRequests = false;

    public string $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';

    public string $sessionCookieName = 'ci_session';

    public int $sessionExpiration = 7200;

    public string $sessionSavePath = WRITEPATH . 'session';

    public bool $sessionMatchIP = false;

    public int $sessionTimeToUpdate = 300;

    public bool $sessionRegenerateDestroy = false;

    public string $cookiePrefix = '';

    public string $cookieDomain = '';

    public string $cookiePath = '/';

    public bool $cookieSecure = false;

    public bool $cookieHTTPOnly = true;

    public string $cookieSameSite = 'Lax';

    public bool $proxyIPs = false;

    public string $CSRFTokenName = 'csrf_test_name';

    public string $CSRFHeaderName = 'X-CSRF-TOKEN';

    public string $CSRFCookieName = 'csrf_cookie_name';

    public int $CSRFExpire = 7200;

    public bool $CSRFRegenerate = true;

    public bool $CSRFRedirect = true;

    public string $CSRFSameSite = 'Lax';

    public bool $CSPEnabled = false;
}

