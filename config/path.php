<?php

// Set base URL
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/dualD/';

// Fungsi helper untuk membuat URL
function url($path = '') {
    global $base_url;
    return $base_url . ltrim($path, '/');
}