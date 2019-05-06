<?php
/**
 * User: shahnuralam
 * Date: 8/4/18
 * Time: 4:05 PM
 */

namespace WPDM\Block;

if (!defined('ABSPATH')) die();

class Panel{

    function __construct(){
        add_action( 'init', array($this, 'block'), 9 );
    }

    function block(){
        wp_register_script(
            'wpdm-panel-block',
            plugins_url('js/panel.js', __WPDM_GB__),
            array( 'wp-blocks', 'wp-element','wpdm-bootstrap', 'wpdm-icons' )
        );

        register_block_type( 'download-manager/panel', array(
            'attributes'      => array(
                'title' => array(
                    'type' => 'array',
                    'source' => 'children',
                    'selector' =>  '.title'
                ),
                'panel_id' => array(
                    'type' => 'string'
                ),
                'content' => array(
                    'type' => 'array',
                    'source' => 'children',
                    'selector' =>  '.content'
                ),
                'titleColor' => array(
                    'type' => 'string',
                    'default' =>  '#333333'
                ),
                'headerBG' => array(
                    'type' => 'string',
                    'default' =>  '#eeeeee'
                ),
                'borderColor' => array(
                    'type' => 'string',
                    'default' =>  '#dddddd'
                ),
                'textColor' => array(
                    'type' => 'string',
                    'default' =>  '#333333'
                )
            ),
            'editor_script' => 'wpdm-panel-block',
            'editor_style' => 'wpdm-block-style',
            //'render_callback' => array($this, 'output'),
        ) );
    }

    function output( $attributes, $content){
        if(get_post_type($attributes['packageID']) != 'wpdmpro') return "<div class='w3eden'><div class='well text-center'>".__('Select a package!', 'wpdmpro')."</div></div>";
        return do_shortcode("[wpdm_package id='{$attributes['packageID']}' template='{$attributes['template']}' ]");
    }

}

new Panel();

