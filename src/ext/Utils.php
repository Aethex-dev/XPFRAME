<?php

/**
 * COPYRIGHT XENONMC 2019 - Current
 *
 * XPFRAME and all of its named materials rights belong to XENONMC
 * You may fork and redistribute materials of this framework as long as proper crediting is given, learn more at https://xenonmc.xyz/resources/XENONMC/XPFRAME/copyright
 *
 * @package XENONMC\XPFRAME\ext
 * @author XENONMC <support@xenonmc.xyz>
 * @website https://xenonmc.xyz
 *
 */

namespace XENONMC\XPFRAME\ext;

class Utils
{

    /**
     * fill an array and overwrite values if a key for it is defined in the overwrite array
     *
     * @param array $fillable
     * @param array $overwrite
     *
     * @return array
     *
     */

    public static function fill_array(array $fillable, array $overwrite): array
    {

        foreach ($fillable as $fillable_key => $fillable_value) {

            if (isset($overwrite[$fillable_key])) {

                $fillable[$fillable_key] = $overwrite[$fillable_key];
            }
        }

        return $fillable;
    }
}