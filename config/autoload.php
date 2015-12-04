<?php

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(
    array(
        'CT_EYE'
    )
);


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'CT_EYE\swatchBook'             => 'system/modules/swatchBook/classes/swatchBook.php',

    // Models
    'CT_EYE\SwatchBookModel'	    => 'system/modules/swatchBook/models/SwatchBookModel.php',
    'CT_EYE\SwatchBookColorsModel'	=> 'system/modules/swatchBook/models/SwatchBookColorsModel.php',

    //Module
    'CT_EYE\ModuleSwatchBook'	    => 'system/modules/swatchBook/modules/ModuleSwatchBook.php'
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_swatchBook'       		=> 'system/modules/swatchBook/templates',
	'ce_swatchBookItems'   	    => 'system/modules/swatchBook/templates',
	'be_wildcard_swatchBook'    => 'system/modules/swatchBook/templates'
));
