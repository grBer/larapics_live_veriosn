<?php

//Version 1

$target = __DIR__ . '/larapics/storage/app/public';
$link = __DIR__ . '/storage';

if (file_exists($link)) {
    echo "Symlink already exists.\n";
} else {
    if (symlink($target, $link)) {
        echo "Symlink created successfully.\n";
    } else {
        echo "Failed to create symlink.\n";
    }
}

//Version 2

/* $target = __DIR__ . '\larapics\storage\app\public';
$link = __DIR__ . '\storage';

if (file_exists($link)) {
    echo "Junction point already exists.\n";
} else {
    $command = "mklink /J \"{$link}\" \"{$target}\"";
    $output = [];
    $returnVar = 0;
    exec($command, $output, $returnVar);
    
    if ($returnVar === 0) {
        echo "Junction point created successfully.\n";
    } else {
        echo "Failed to create junction point. Error: " . implode("\n", $output) . "\n";
    }
} */

