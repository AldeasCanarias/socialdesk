<?php
/**
 * User: shahnuralam
 * Date: 8/19/18
 * Time: 1:01 PM
 */
/**
 * Plugin Name:  WPDM - Gutenberg Blocks
 * Plugin URI: https://www.wpdownloadmanager.com/download/gutenberg-blocks/
 * Description: Gutenberg Blocks for WordPress Download Manager
 * Author: WordPress Download Manager
 * Version: 1.2.2
 * Author URI: https://www.wpdownloadmanager.com/
 */

namespace WPDM\Block;

define("__WPDM_GB__", __FILE__);
define("__WPDM_GBDIR__", __DIR__);

class Blocks
{

    function __construct()
    {

        if(!$this->gutenbergActive()) return;

        include dirname(__FILE__).'/libs/class.RestAPI.php';

        add_filter( 'block_categories', function( $categories, $post ) {

            $categories = array_merge(
                $categories,
                array(
                    array(
                        'slug' => 'wpdm-blocks',
                        'title' => __( 'Download Manager Blocks', 'wpdm-blocks' ),
                    ),
                )
            );
            return $categories;
        }, 10, 2 );

        add_action("init", array($this, 'registerScripts'), 10);
        add_action("wp_enqueue_scripts", array($this, 'enqueueScripts'), 1);

        include "blocks/package.php";
        include "blocks/packages.php";
        include "blocks/category.php";
        include "blocks/category-blocks.php";
        include "blocks/panel.php";
        include "blocks/call2action.php";
        //include "blocks/card-slider.php";
    }


    function gutenbergActive(){
        global $wp_version;
        return defined('GUTENBERG_VERSION') || version_compare( $wp_version, '5.0', '>=' );
    }


    function registerScripts(){

        wp_register_style(
            'wpdm-block-style-front',
            plugins_url('css/block-front.css', __FILE__), array('font-awesome')
        );

        wp_register_style(
            'wpdm-block-style',
            plugins_url('css/block.css', __FILE__), array('wpdm-bootstrap', 'wpdm-front', 'wpdm-font-awesome')
        );

        wp_register_script(
            'wpdm-gb-util',
            plugins_url('js/libs/util.js', __FILE__)
        );

        wp_register_script(
            'wpdm-link-templates',
            plugins_url('js/libs/link-templates.js', __FILE__)
        );

        wp_register_script(
            'wpdm-package-selector',
            plugins_url('js/libs/package-selector.js', __FILE__)
        );

        wp_register_script(
            'wpdm-category-selector',
            plugins_url('js/libs/category-selector.js', __FILE__)
        );

        wp_register_script(
            'wpdm-category-dropdown',
            plugins_url('js/libs/category-dropdown.js', __FILE__)
        );

        wp_register_script(
            'wpdm-icons',
            plugins_url('js/libs/icons.js', __FILE__)
        );

    }

    function enqueueScripts(){
        wp_enqueue_style('wpdm-block-style-front');
    }

}

new Blocks();