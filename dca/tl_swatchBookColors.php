<?php

/**
 * Contao Extension swatchBook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */

$GLOBALS['TL_DCA']['tl_swatchBookColors'] = array
(
  'config' => array
  (
    'dataContainer'	    => 'Table',
    'ptable'            => 'tl_swatchBook',
    'onsubmit_callback' => array(array('tl_swatchBookColors','createCSS')),

    'sql'               => array
    (
       'keys' => array
        (
           'id' => 'primary',
           'pid' => 'index'
        )
    )
  ),

  'list' => array
  (
    'sorting' => array
    (
        'mode'			        => 4,
		'fields'		        => array('sorting'),
        'headerFields'			=> array('title'),
        'child_record_callback'	=> array('tl_swatchBookColors','listObjLabel')
	),
    'global_operations' => array
    (
      'all' => array
      (
        'label'         => &$GLOBALS['TL_LANG']['MSC']['all'],
        'href'          => 'act=select',
        'class'         => 'header_edit_all',
        'attributes'    => 'onclick="Backend.getScrollOffset()" accesskey="e"'
      )
    ),
    
    'operations' => array
    (
      'edit' => array
      (
          'label'         => &$GLOBALS['TL_LANG']['tl_swatchBookColors']['edit'],
          'href'		  => 'act=edit',
          'icon'          => 'edit.gif'
      ),
      'copy' => array
      (
        'label'             => &$GLOBALS['TL_LANG']['tl_swatchBookColors']['copy'],
        'href'              => 'act=copy',
        'icon'              => 'copy.gif'
      ),
      'cut' => array
      (
          'label'               => &$GLOBALS['TL_LANG']['tl_swatchBookColors']['cut'],
          'href'                => 'act=paste&amp;mode=cut',
          'icon'                => 'cut.gif',
          'attributes'          => 'onclick="Backend.getScrollOffset()"'
      ),
      'show' => array
      (
          'label'       => &$GLOBALS['TL_LANG']['tl_swatchBookColors']['show'],
          'href'        => 'act=show',
          'icon'        => 'show.gif'
      ),
      'delete'  => array(
          'label'             => &$GLOBALS['TL_LANG']['tl_swatchBookColors']['show'],
          'href'              => 'act=delete',
          'icon'        => 'delete.gif'
      )
  ),
  ),
  'palettes' => array
  (
    'default'	=>'{info_legend},title,color;'

  ),
  'fields' => array
  (
    'id' => array
    (
        'sql'           => "int(10) unsigned NOT NULL auto_increment"
    ),
    'pid' => array
    (
       'foreignKey'     => 'tl_swatchBook.id',
       'sql'            => "int(10) unsigned NOT NULL default '0'"
    ),
    'sorting' => array
    (
        'sql'                     => "int(10) unsigned NOT NULL default '0'"
    ),
    'tstamp' => array
    (
        'sql'           => "int(10) unsigned NOT NULL default '0'"
    ),
    'title' => array
    (
      'label'           => &$GLOBALS['TL_LANG']['tl_swatchBookColors']['title'],
      'exclude'         => true,
      'inputType'       => 'text',
      'eval'            => array('tl_class'=>'w50'),
      'sql'             => "varchar(255) NOT NULL default ''"
    ),
    'color' => array
    (
        'label'         => &$GLOBALS['TL_LANG']['tl_swatchBookColors']['color'],
        'exclude'       => true,
        'inputType'     => 'text',
        'eval'          => array('colorpicker'=>true,'tl_class'=>'w50'),
        'sql'           => "varchar(7) NOT NULL default ''"
    )
   )
);

class tl_swatchBookColors extends \Backend
{
    /**
     * label Callback
    */
    public function listObjLabel($arrRow)
    {
        $template = '<ul style="width:auto;height:auto;display:-webkit-flex;display:flex;margin:0;padding:0;justify-content:center;float:left;">
    				    <li style="list-style:none;color:#%s;text-align:center;width:60px;padding:5px 0;background-color:#%s;">#%s</li>
    				    <li style="list-style:none;padding:5px 0 5px 10px;text-transform:uppercase;">%s</li>
                     </ul>';

        $pos = strpos(substr(strtoupper($arrRow['color']),0,1),"F");


        return sprintf($template,
                       ($pos === false) ? 'fff': '555' ,
                       $arrRow['color'],
                       $arrRow['color'],
                       $arrRow['title']
            );
    }


    /**
     * create CSS File
     * file :: assets/css/divElements.css
     */
    public function createCSS()
    {
        // create File if doesn`t exists
        $file  = new \File('system/modules/swatchBook/assets/css/divElements.css');

        // result Color
        $groupPalette   = \Database::getInstance()->execute("SELECT pid,count(pid) AS count FROM tl_swatchBookColors GROUP BY pid")->fetchAllAssoc();
        $palettes       = \Database::getInstance()->execute("SELECT id,pid,title,color FROM tl_swatchBookColors")->fetchAllAssoc();

        foreach($groupPalette as $c) {
            $i = 1;
            foreach ($palettes as $v)
            {
                if($c['pid'] == $v['pid']) {

                    $css[] = sprintf("#sb-container-%s div:nth-child(%s){background-color: #%s;box-shadow: -1px -1px 3px rgba(0,0,0,0.1), %spx %spx %spx rgba(0,0,0,0.1);-webkit-box-shadow: -1px -1px 3px rgba(0,0,0,0.1), %spx %spx %spx rgba(0,0,0,0.1);-moz-box-shadow: -1px -1px 3px rgba(0,0,0,0.1), %spx %spx %spx rgba(0,0,0,0.1);}",
                        $v['pid'],
                        ($i <= $c['count']) ? $i : $c['count'],
                        $v['color'],
                        $v['id'],
                        $v['id'],
                        $v['id'],
                        $v['id'],
                        $v['id'],
                        $v['id'],
                        $v['id'],
                        $v['id'],
                        $v['id']
                    );
                    $i++;
                }
            }
        }

        \File::putContent('system/modules/swatchBook/assets/css/divElements.css',implode("\n", $css) );

    }


}