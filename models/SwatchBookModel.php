<?php

/**
 * Contao Extension swatchBook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */

namespace CT_EYE;

class SwatchBookModel extends \Model
{
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_swatchBook';

    public static function getPaletteMessage($intId, array $arrOptions=array()) {
        $t = static::$strTable;

        $arrColumns = array("$t.id=?");

        return static::findBy($arrColumns, array((int) $intId), $arrOptions);
    }
}