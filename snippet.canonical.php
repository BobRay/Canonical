<?php
/**
 * @package canonical
 * @author Bob Ray <bobray@softville.com>
 * @created 07-31-2010
 * @version 1,0
 * @release beta1
*/


/******************************
*             Usage           *
*******************************

/*

Simply install the snippet with Package Manager and put the
following snippet tag in the <head> section of all templates
[[!Canonical]]
*/

/* Canonical snippet */
/* Author Bob Ray */
/* produces an appropriate canonical tag for home and other pages */
/* put the snippet tag [[Canonical]]  in the <head> section of your template(s) */
return $modx->resource->id == $modx->getOption('site_start') ? '<link rel="canonical" href="[[++site_url]]" />' : '<link rel="canonical" href="[[++site_url]][[~[[*id]]]]" />';
?>

