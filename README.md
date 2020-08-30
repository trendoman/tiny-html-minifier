# CouchCMS HTML Minifer

CouchCMS Addon. Adds a new `<cms:minify>`-Tag to minify/compress the HTML Output.

## Installation

1. Download Add-On
2. Extract directory `tiny-html-minifier` in `'couch/addons'` folder.
3. Add the following entry in `'couch/addons/kfunctions.php'` file<br>(if this file is not found, rename the `kfunctions.example.php` file to `kfunctions.php`)

``` php
require_once( K_COUCH_DIR.'addons/tiny-html-minifier/TinyMinify.php' );
```

## Usage

This addon makes available a new `<cms:minify>`-Tag. It is very simple to use:

``` html
<cms:minify>
    <!-- here comes your HTML and CMS code :) -->
    <p>Compression works:</p>
    <ul>
        <li>
            Really?
        </li>
        <li>
            Really!
        </li>
    </ul>
</cms:minify>
```

Code will minified to:

``` html
<p>Compression works:</p> <ul> <li> Really? </li> <li> Really! </li> </ul> 
```

## Parameter

* collapse_whitespace
* disable_comments

Both parameter are boolean and can set to `true` or `false` (default is `false`):

``` html
<cms:minify collapse_whitespace="true" disable_comments="true"></cms:minify>
```

## Requirements
PHP7+