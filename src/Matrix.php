<?php

namespace MatrixMlm;


use MatrixMlm\Model\Commission;
use MatrixMlm\Model\Level;
use MatrixMlm\Model\Member;

class Matrix
{

    public static function initialize()
    {
        register_activation_hook(MATRIX_MLM_PLUGIN_DIR, ['MatrixMlm\Matrix', 'activationHook']);
        register_deactivation_hook(MATRIX_MLM_PLUGIN_DIR, ['MatrixMlm\Matrix', 'deactivationHook']);
        register_uninstall_hook(MATRIX_MLM_PLUGIN_DIR, ['MatrixMlm\Matrix', 'uninstallHook']);

        add_action( 'admin_menu', ['MatrixMlm\Matrix', 'adminMenu'] );
        add_action( 'plugins_loaded', ['MatrixMlm\Matrix', 'dbChecker'] );
    }

    public static function activationHook()
    {
        $member = new Member();
        $member->install();

        $commission = new Commission();
        $commission->install();

        $level = new Level();
        $level->install();

        add_site_option( 'matrix_db_version', MATRIX_MLM_DB_VERSION );
    }

    public static function deactivationHook()
    {

    }

    public static function uninstallHook()
    {
        $member = new Member();
        $member->remove();

        $commission = new Commission();
        $commission->remove();

        $level = new Level();
        $level->remove();

        delete_site_option( 'matrix_db_version' );
    }

    public static function dbChecker()
    {
        $installedVer = get_site_option( "matrix_db_version" );
        if ($installedVer !== MATRIX_MLM_DB_VERSION) {
            self::activationHook();
            update_site_option( 'matrix_db_version', MATRIX_MLM_DB_VERSION );
        }
    }

    public static function adminMenu() {
        add_menu_page(
            __( 'Matrix MLM Plugin'),
            __( 'Matrix MLM'),
            'manage_options',
            'matrix',
            'matrix_view',
            'dashicons-chart-pie',
            null
        );
    }
}