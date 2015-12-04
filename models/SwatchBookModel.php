<?php

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