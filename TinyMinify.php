<?php

if( ! defined('K_COUCH_DIR') ) die(); // cannot be loaded directly
if( ! class_exists('TinyHtmlMinifier') ) require_once( K_ADDONS_DIR.'tiny-html-minifier/TinyHtmlMinifier.php' );

class TinyMinify
{

    public static function minify($params, $node)
    {
        global $FUNCS;

        $options = $FUNCS->get_named_vars(
            array(
                'disable_comments' => 0,
                'collapse_whitespace' => 0,
            ), $params);

        $options = array_map( function(&$option){ return (bool) $option; }, $options);
        $options['disable_comments'] ^= 1;

        foreach ($node->children as $child) {
            $html .= $child->get_HTML();
        }

        $minifier = new TinyHtmlMinifier($options);
        return $minifier->minify($html);
    }

    public static function minify_page( $params, $node )
    {
        global $FUNCS, $PAGE;
        if( count($node->children) ) {die("ERROR: Tag \"".$node->name."\" is a self closing tag");}

        $options = $FUNCS->get_named_vars(
                       array(
                              'disable_comments' => 0,
                              'collapse_whitespace' => 0,
                             ),
                       $params
                    );

        $options = array_map( function(&$option){ return (bool) $option; }, $options);
        $options['disable_comments'] ^= 1;

        $PAGE->minify = 1;
        $PAGE->minify_options = $options;
    }

    public static function alter_minify(&$html, $PAGE, $k_cache_file, $redirect_url, $content_type_header)
    {
        if( ! is_null($redirect_url) ){ return; }

        // comment following to always compress all pages without tag
        if( ! isset($PAGE->minify) && $PAGE->minify !== 1 ){ return; }

        $minifier = new TinyHtmlMinifier($PAGE->minify_options);
        $html = $minifier->minify($html);
    }

}

$FUNCS->register_tag( 'minify', array('TinyMinify', 'minify') );
$FUNCS->register_tag( 'minify_page', array('TinyMinify', 'minify_page') );
$FUNCS->add_event_listener( 'alter_final_page_output', array('TinyMinify', 'alter_minify') );
