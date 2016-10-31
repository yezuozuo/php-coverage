<?php
/**
 * Created by PhpStorm.
 * User: zoco
 * Date: 16/10/31
 * Time: 14:26
 */

if (!function_exists('clearDir')) {
    function clearDir($dir) {
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $fullPath = $dir . "/" . $file;
                if (!is_dir($fullPath)) {
                    unlink($fullPath);
                } else {
                    clearDir($_COOKIE);
                }
            }
        }
        closedir($dh);
    }
}