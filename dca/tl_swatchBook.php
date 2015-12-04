<?php


$GLOBALS['TL_DCA']['tl_swatchBook'] = array
(
  'config' => array
  (
    'dataContainer'		=> 'Table',
    'switchToEdit'		=> true,
    'ctable'		    => array('tl_swatchBookColors'),
    'sql'               => array
    (
       'keys' => array
        (
           'id' => 'primary'
        )
    )
  ),

  'list' => array
  (
    'sorting' => array
    (
    	'mode'			=> 1,
        'flag'			=> 1,
		'fields'		=> array('title'),
	),
	
	'label' => array
	(
		'fields'		=> array('title'),
		'format'		=> '%s',
        'label_callback'=> array('tl_swatchBook','labelCallback')
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
          'label'       => &$GLOBALS['TL_LANG']['tl_swatchBook']['edit'],
          'href'		=> 'table=tl_swatchBookColors',
          'icon'        => 'edit.gif'
      ),
      'editheader' => array
      (
          'label'       => &$GLOBALS['TL_LANG']['tl_swatchBook']['editheader'],
          'href'		=> 'act=edit',
          'icon'        => 'header.gif'
      ),
      'copy' => array
      (
        'label'         => &$GLOBALS['TL_LANG']['tl_swatchBook']['copy'],
        'href'          => 'act=copy',
        'icon'          => 'copy.gif'
      ),
      'delete'  => array(
          'label'       => &$GLOBALS['TL_LANG']['tl_swatchBook']['show'],
          'href'        => 'act=delete',
          'icon'        => 'delete.gif'
      )
    )
  ),

  'palettes' => array
  (
    'default'	=>'{palettes_legend},title,text;
                   {advice_legend:hide},advice;'

  ),

  'fields' => array
  (
    'id' => array
    (
        'sql'               => "int(10) unsigned NOT NULL auto_increment"
    ),
    'tstamp' => array
    (
        'sql'               => "int(10) unsigned NOT NULL default '0'"
    ),
    'title' => array
    (
      'label'               => &$GLOBALS['TL_LANG']['tl_swatchBook']['title'],
      'exclude'                 => true,
      'inputType'           => 'text',
      'eval'                => array('tl_class'=>'w50'),
      'sql'                 => "varchar(255) NOT NULL default ''"
    ),
    'text' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_swatchBook']['text'],
        'exclude'                 => true,
        'inputType'               => 'textarea',
        'eval'                    => array('tl_class'=>'clr long'),
        'sql'                     => 'text NULL'
    ),
    'advice' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_swatchBook']['advice'],
        'exclude'                 => true,
        'inputType'               => 'textarea',
        'eval'                    => array('rte'=>'tinyMCE','tl_class'=>'clr long'),
        'sql'                     => 'text NULL'
    )
   )
);

class tl_swatchBook extends \Backend {
    public function labelCallback($arrRow)
    {
        $sql = \Database::getInstance()->prepare("SELECT count(*) AS count FROM tl_swatchBookColors WHERE pid=?")->execute($arrRow['id'])->fetchAssoc();
        return sprintf('<strong>%s</strong> - <span style="color:#969696;" >[ %s ]</span>',$arrRow['title'],$sql['count']);
    }
}