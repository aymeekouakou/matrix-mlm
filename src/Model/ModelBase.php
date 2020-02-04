<?php


namespace MatrixMlm\Model;


require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


abstract class ModelBase
{
    public $options;
    public $table_name;

    abstract public function sql(): string;

    public function install()
    {
        global $wpdb;

        if (!array_key_exists('prefix', $this->options)) {
            $this->options['prefix'] = $wpdb->prefix;
        }

        if (!array_key_exists('table', $this->options)) {
            $this->options['table'] = $this->table_name;
        }
    }

    public function update()
    {
        global $wpdb;

        if (!array_key_exists('prefix', $this->options)) {
            $this->options['prefix'] = $wpdb->prefix;
        }

        if (!array_key_exists('table', $this->options)) {
            $this->options['table'] = $this->table_name;
        }
    }

    public function remove()
    {
        global $wpdb;

        if (!array_key_exists('prefix', $this->options)) {
            $this->options['prefix'] = $wpdb->prefix;
        }

        if (!array_key_exists('table', $this->options)) {
            $this->options['table'] = $this->table_name;
        }
    }
}