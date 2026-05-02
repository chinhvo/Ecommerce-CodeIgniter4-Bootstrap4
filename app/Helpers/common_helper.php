<?php

use Config\App;

function getTextualPages($activePages)
{
    // Load config (replace App with your config file name if different)
    $config = config(App::class);

    // Access the config item
    $arr = $config->no_dynamic_pages ?? [];

    $withDuplicates = array_merge($activePages, $arr);

    if (empty($activePages)) {
        return $activePages;
    }

    return array_diff(
        $withDuplicates,
        array_diff_assoc($withDuplicates, array_unique($withDuplicates))
    );
}
