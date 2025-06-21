<?php

// Set base URL
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/dualD/';

// Fungsi helper untuk membuat URL
function url($path = '') {
    global $base_url;
    return $base_url . ltrim($path, '/');
}

function get_stylesheet_path() {
    // Deteksi apakah kita berada di localhost atau production
    $is_local = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;
    
    // Path untuk CSS
    $css_path = '/assets/css/style.css';
    
    // Jika di localhost dan ada folder dualD
    if ($is_local && strpos($_SERVER['REQUEST_URI'], 'dualD') !== false) {
        return '/dualD' . $css_path;
    }
    
    return $css_path;
}