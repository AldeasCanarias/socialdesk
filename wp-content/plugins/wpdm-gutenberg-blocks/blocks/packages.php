<?php
/**
 * User: shahnuralam
 * Date: 10/01/19
 * Time: 07:46 PM
 */

namespace WPDM\Block;

if (!defined('ABSPATH')) die();

class Packages{

    function __construct(){
        add_action( 'init', array($this, 'block'), 9 );
    }

    function block(){
        wp_register_script(
            'wpdm-packages-block',
            plugins_url('js/packages.js', __WPDM_GB__),
            array( 'wp-blocks', 'wp-element','wpdm-bootstrap', 'wpdm-icons', 'wpdm-link-templates', 'wpdm-category-selector' )
        );

        register_block_type( 'download-manager/packages', array(
            'attributes'      => array(
                'search' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'cats' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'cat_relation' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'xcats' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'tag' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'tag__not_in' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'author' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'author__not_in' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'title' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'desc' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'toolbar' => array(
                    'type'    => 'string',
                    'default' => "1"
                ),
                'items_per_page' => array(
                    'type'    => 'number',
                    'default' => 10
                ),
                'paging' => array(
                    'type'    => 'number',
                    'default' => 1
                ),
                'cols' => array(
                    'type'    => 'number',
                    'default' => 1
                ),
                'order_by' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'order' => array(
                    'type'    => 'string',
                    'default' => ""
                ),
                'template'      => array(
                    'type'      => 'string',
                    'default'   => 'link-template-panel'
                )
            ),
            'editor_script' => 'wpdm-packages-block',
            'editor_style' => 'wpdm-block-style',
            'render_callback' => array($this, 'output'),
        ) );
    }

    function output( $attributes, $content){

        global $WPDM;

        if(method_exists($WPDM->shortCode, 'packages'))
            return $WPDM->shortCode->packages($attributes);
        else
            return \WPDM_Messages::info("Block is available with the pro version only!");
    }

}

new Packages();

