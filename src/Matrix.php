<?php

namespace MatrixMlm;


class Matrix
{

    public static function initialize()
    {
        register_activation_hook(MATRIX_MLM_PLUGIN_DIR, ['MatrixMlm\Matrix', 'activationHook']);
        register_deactivation_hook(MATRIX_MLM_PLUGIN_DIR, ['MatrixMlm\Matrix', 'deactivationHook']);
        register_uninstall_hook(MATRIX_MLM_PLUGIN_DIR, ['MatrixMlm\Matrix', 'uninstallHook']);

        add_action( 'admin_menu', ['MatrixMlm\Matrix', 'adminMenu'] );
    }

    public static function activationHook()
    {

    }

    public static function deactivationHook()
    {

    }

    public static function uninstallHook()
    {

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