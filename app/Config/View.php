<?php

namespace Config;

use CodeIgniter\Config\View as BaseView;

class View extends BaseView
{
    public string $filters = [];

    public array $plugins = [];
}

