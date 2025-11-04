<?php

namespace Config;

/**
 * This class is used to detect the base URL of your CodeIgniter
 * application from the request in order to help generate links.
 */
class BaseURL extends \CodeIgniter\Config\BaseConfig
{
    public string $baseURL = 'http://localhost:8080/';

    public string $indexPage = 'index.php';

    public string $uriProtocol = 'REQUEST_URI';
}


