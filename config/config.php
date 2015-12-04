<?php

/**
 * Back Navigation
 */
array_insert($GLOBALS['BE_MOD'],0, array('ct_eye' 	=> array
(
	'swatchBook'	=> array
	(
		'tables' 	=> array('tl_swatchBook','tl_swatchBookColors'),
		'icon'		=> 'system/modules/swatchBook/assets/images/swatchColorPalettes.png'
	)
)));



/**
 * Content elements
 */
$GLOBALS['TL_CTE']['swatchBook']['swatchBook'] = 'swatchBook';


/**
  * Load Backend or Frontend
 *  CSS/JavaScript
 */
if (TL_MODE == 'FE')
{
    $GLOBALS['TL_CSS'][]    = 'system/modules/swatchBook/assets/css/style.css';
    $GLOBALS['TL_CSS'][] 	= 'system/modules/swatchBook/assets/css/divElements.css';
}