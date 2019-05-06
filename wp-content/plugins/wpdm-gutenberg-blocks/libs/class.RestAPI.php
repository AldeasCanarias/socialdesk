<?php
/**
 * User: shahnuralam
 * Date: 8/21/18
 * Time: 7:15 AM
 */

namespace WPDM\Block\libs;

class RestAPI
{

    function __construct()
    {

        add_action( 'rest_api_init', array($this, 'restAPIInit'));
    }

    function restAPIInit(){

        //wpdm/v1/search-package
        register_rest_route( 'wpdm/v1', '/search-package', array(
            'methods' => 'GET',
            'callback' => array($this, 'searchPackages'),
        ) );

        //wpdm/v1/link-templates
        register_rest_route( 'wpdm/v1', '/link-templates', array(
            'methods' => 'GET',
            'callback' => array($this, 'linkTemplates'),
        ) );

        //wpdm/v1/categories
        register_rest_route( 'wpdm/v1', '/categories', array(
            'methods' => 'GET',
            'callback' => array($this, 'categories'),
        ) );
    }

    function linkTemplates()
    {
        $type = 'link';
        $tplstatus = maybe_unserialize(get_option("_fm_link_template_status"));
        $activetpls = array();
        if(is_array($tplstatus)) {
            foreach ($tplstatus as $tpl => $active) {
                if ($active)
                    $activetpls[] = $tpl;
            }
        }

        $ttpldir = get_stylesheet_directory() . '/download-manager/' . $type . '-templates/';
        $ttpls = array();
        if(file_exists($ttpldir)) {
            $ttpls = scandir($ttpldir);
            array_shift($ttpls);
            array_shift($ttpls);
        }

        $ltpldir = WPDM_TPL_DIR . $type . '-templates/';
        $ctpls = scandir($ltpldir);
        array_shift($ctpls);
        array_shift($ctpls);

        foreach($ctpls as $ind => $tpl){
            $ctpls[$ind] = $ltpldir.$tpl;
        }

        foreach($ttpls as $tpl){
            if(!in_array($ltpldir.$tpl, $ctpls)) {
                $ctpls[] = $ttpldir . $tpl;
            }
        }

        $custom_templates = maybe_unserialize(get_option("_fm_{$type}_templates",true));

        $name = isset($name)?$name:$type.'_template';
        $css = isset($css)?"style='$css'":'';
        $id = isset($id)?$id:uniqid();
        $default = $type == 'link'?'link-template-calltoaction3.php':'page-template-1col-flat.php';
        $xdf = str_replace(".php", "", $default);
        if(is_array($activetpls) && count($activetpls) > 0)
            $default = in_array($xdf, $activetpls)?$default:$activetpls[0];

        $data = array();
        foreach ($ctpls as $ctpl) {
            $ind = str_replace(".php", "", basename($ctpl));
            if(!isset($tplstatus[$ind]) || $tplstatus[$ind] == 1) {
                $tmpdata = file_get_contents($ctpl);
                $regx = "/WPDM.*Template[\s]*:([^\-\->]+)/";
                if (preg_match($regx, $tmpdata, $matches)) {
                    $data[] = array('value' => basename($ctpl), 'label' => $matches[1]);
                }
            }
        }

        if(is_array($custom_templates)) {
            foreach ($custom_templates as $id => $template) {
                if(!isset($tplstatus[$id]) || $tplstatus[$id] == 1) {
                    $data[] = array('value' => $id, 'label' => $template['title']);
                }
            }
        }

        wp_send_json($data);
        die();

    }

    function searchPackages(){

        $packs = get_posts(array('post_type' => 'wpdmpro','s' => wpdm_query_var('s', 'txt'), 'posts_per_page' => 10));
        foreach ($packs as $pack){
            $data[] = array('id' => $pack->ID, 'title' => $pack->post_title);
        }
        wp_send_json($data);
        die();

    }

    function categories(){
        $cats = get_terms(array('taxonomy' => 'wpdmcategory',
            'hide_empty' => false));
        foreach ($cats as $cat){
            $data[] = array('value' => $cat->slug, 'id' => $cat->term_id, 'label' => $cat->name);
        }
        wp_send_json($data);
        die();

    }





}

new RestAPI();