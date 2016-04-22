<?php

/**
 * Contao Extension swatchBook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */


/**
 * Extension version
 */
@define('VERSION', '1.1');
@define('BUILD', '0');


/**
 * Backend
 */
array_insert($GLOBALS['BE_MOD'],0, array('ct_eye' 	=> array
(
	'swatchBook'	=> array
	(
		'tables' 	=> array('tl_swatchBook','tl_swatchBookColors'),
		'icon'		=> 'system/modules/swatchBook/assets/images/swatchbook-icon.png'
	)
)));

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['swatchBook']['swatchBook'] = 'swatchBook';
