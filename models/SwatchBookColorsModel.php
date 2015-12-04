<?php

/**
 * Contao Extension swatchBook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */

namespace CT_EYE;
use Contao\Model;

class SwatchBookColorsModel extends \Model
{
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_swatchBookColors';


    public static function getColorList($intParent, array $arrOptions=array()) {
        $t = static::$strTable;

        $arrColumns = array("$t.pid=?");

        return static::findBy($arrColumns, array((int) $intParent), $arrOptions);

    }
}