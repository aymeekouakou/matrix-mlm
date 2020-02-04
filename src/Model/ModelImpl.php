<?php


namespace MatrixMlm\Model;

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

interface ModelImpl
{
    public function sql();
    public function install();
}