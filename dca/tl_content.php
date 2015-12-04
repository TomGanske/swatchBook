<?php
/**
 * SeasonPlan extension for Contao Open Source CMS
 *
 * @copyright  
 * @author    
 * @license
 * @link
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['swatchBook'] = '{type_legend},type,headline,name,colorSources;{template_legend:hide},swatchBook_Template;{expert_legend:hide},cssID,space';

$GLOBALS['TL_DCA']['tl_content']['fields']['headline'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['default']['headline'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'inputUnit',
    'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
    'eval'                    => array('maxlength'=>200,'tl_class'=>'w50'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['swatchBook_Template'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['default']['swatchBook_Template'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => array('swatchBookPalettes', 'getElementTemplates'),
    'eval'                    => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['colorSources'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['default']['colorSources'],
    'exclude'                 => true,
    'inputType'               => 'checkboxWizard',
    'options_callback'        => array('swatchBookPalettes', 'swatchBookSelectColors'),
    'eval'                    => array('multiple'=>true,'tl_class'=>'clr m12'),
    'sql'                     => "text NULL"
);


class swatchBookPalettes extends \Backend
{
    /**
     * return array for options Content element
     */
    public function getListPalettes()
    {
        $res = \Database::getInstance()->query("SELECT * FROM tl_swatchBook ORDER BY id")->fetchAllAssoc();

        foreach($res as $key=>$value)
        {
            $items[$value['id']] = $value['title'];
        }

        return $items;
    }

    /**
     * Return all content element templates as array
     * @return array
     */
    public function getElementTemplates()
    {
        return $this->getTemplateGroup('ce_');
    }


    public function swatchBookSelectColors()
    {
        $row = \Database::getInstance()->execute("SELECT * FROM tl_swatchBook ORDER BY id");

        while($row->next())
        {
            $items[$row->id] = $row->title;
        }

        return $items;
    }
}