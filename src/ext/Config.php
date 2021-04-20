<?php

/**
 * COPYRIGHT XENONMC 2019 - Current
 *
 * XPFRAME and all of its named materials rights belong to XENONMC
 * You may fork and redistribute materials of this framework as long as proper crediting is given, learn more at https://xenonmc.xyz/resources/XENONMC/XPFRAME/copyright
 *
 * @package XENONMC\XPFRAME\cli
 * @author XENONMC <support@xenonmc.xyz>
 * @website https://xenonmc.xyz
 *
 */

namespace XENONMC\XPFRAME\ext;

// class imports
use \Symfony\Component\Yaml\Yaml;

class Config
{

    /**
     * constructor
     *
     */

    public function __construct()
    {

    }

    /**
     * get a config
     *
     * @param string , location of the config file
     * 
     * @return array|null , full config tree as an array
     * 
     */

    public static function get(string $location): array|null
    {

        $config['raw'] = file_get_contents($location);
        $config['parsed'] = Yaml::parse($config['raw']);

        return $config['parsed'];
    }
}