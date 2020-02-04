<?php
/**
 * Plugin Name:     Matrix MLM
 * Plugin URI:      https://wordpress.aymardkouakou.me/plugins/matrix
 * Description:     Plugin de gestion d'un réseau MLM
 * Author:          Aymard KOUAKOU
 * Author URI:      https://aymardkouakou.me
 * License:         MIT
 * Text Domain:     matrix-mlm
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         MatrixMlm
 */

// Start here
use MatrixMlm\Matrix;

require_once 'vendor/autoload.php';

define( 'MATRIX_MLM_VERSION', "0.1.0" );
define( 'MATRIX_MLM_DB_VERSION', MATRIX_MLM_VERSION );
define( 'MATRIX_MLM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

$matrix = new Matrix();
$matrix::initialize();
