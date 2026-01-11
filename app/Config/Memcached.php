<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Memcached extends BaseConfig
{   
    /*
     | -------------------------------------------------------------------------
     | Memcached settings
     | -------------------------------------------------------------------------
     | Your Memcached servers can be specified below.
     |
     |	See: https://codeigniter.com/user_guide/libraries/caching.html#memcached
     |
     */
    public array $config = array(
        'default' => array(
            'hostname' => '127.0.0.1',
            'port'     => '11211',
            'weight'   => '1',
        ),
    );
}


