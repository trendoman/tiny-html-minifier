<?php

if (!defined('K_COUCH_DIR')) die(); // cannot be loaded directly
require 'TinyHtmlMinifier.php';

class TinyMinify
{

    public static function minify($params, $node)
    {
        global $FUNCS;

        $options = $FUNCS->get_named_vars(
            array(
                'collapse_whitespace' => "false",
                'disable_comments' => "false"
            ), $params);

        foreach ($options as &$option) {
            $option= (int) filter_var($option, FILTER_VALIDATE_BOOLEAN);
        }

        foreach ($node->children as $child) {
            $html .= $child->get_HTML();
        }


        $minifier = new TinyHtmlMinifier($options);
        return $minifier->minify($html);
    }
}

$FUNCS->register_tag('minify', array('TinyMinify', 'minify'));