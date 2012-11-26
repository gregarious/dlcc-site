<?php

if (!function_exists('getSiteTitle')) {
    function getSiteTitle($subtitle='') {
        $baseSiteTitle = 'The David L. Lawrence Convention Center';
        if ($subtitle) {
            return $subtitle . ' | ' . $baseSiteTitle;
        }
        else {
            return $baseSiteTitle;
        }
    }
}

$isIndexPage = false;
$isBuildingSubpage = false;