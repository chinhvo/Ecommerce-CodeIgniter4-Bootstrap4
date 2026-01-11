<?php
use Config\Services;

function pagination($url, $rowscount, $per_page, $page, $segment = 2)
{
    $pager = Services::pager();
    $pager->setPath($url); // Additionally you could define path for every group.
    
    $link = $pager->makeLinks(
        $page,     // current page number
        $per_page,     // items per page
        $rowscount,   // total items
        'bootstrap_full', // template,
        $segment
        );    

    
    return $link;
}
