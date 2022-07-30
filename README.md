# CouchCMS HTML Minifer

CouchCMS Addon. Adds two new tags to minify/compress the HTML Output.

*minify* compresses the enclosed HTML:

```xml
<cms:minify> .. HTML .. </cms:minify>
```

*minify_page* compresses the whole page

```xml
<cms:minify_page />
```

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

## Parameters

* collapse_whitespace
* disable_comments

Expected values are ***1*** or ***0***. Defaults are ***0***

``` html
<cms:minify_page collapse_whitespace='1' disable_comments='1' />
```

## Requirements

PHP7+
