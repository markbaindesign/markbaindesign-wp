<?php // 

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

function mwe_sort_resources_array(array $all_links)
{
    usort($all_links, function ($a, $b) {

        // Extract link text from possible HTML <a> tag
        $get_text = function ($link) {
            if (preg_match('/<a[^>]*>(.*?)<\/a>/is', $link, $m)) {
                return trim($m[1]);
            }
            return strip_tags($link);
        };

        $textA = $get_text($a);
        $textB = $get_text($b);

        // Extract leading numbers if present
        preg_match('/^\d+/', $textA, $ma);
        preg_match('/^\d+/', $textB, $mb);

        if ($ma && $mb) {
            $numA = (int)$ma[0];
            $numB = (int)$mb[0];
            if ($numA !== $numB) {
                return $numA - $numB;
            }
        } elseif ($ma) {
            return -1;
        } elseif ($mb) {
            return 1;
        }

        return strnatcasecmp($textA, $textB);
    });
    return $all_links;
}
