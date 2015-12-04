<?php

/**
 * Contao Extension swatchBook
 * Copyright (c) 2015-2016 Tom Ganske
 * author     Tom Ganske (http://ct-eye.com ||  https://github.com/TomGanske)
 * @license   LGPL-3.0+
 */

namespace CT_EYE;
use Contao\FrontendTemplate;


class swatchBook extends \ContentElement
{
    protected $strTemplate = "ce_swatchBook";

    // Backend
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard_swatchBook');

            $objTemplate->wildcard 		= '### swatchBook ###';
            $objTemplate->title 		= $this->headline;
            $objTemplate->id 			= $this->id;
            $objTemplate->link 			= $this->name;
            $objTemplate->href 			= 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id='.$this->id;

            return $objTemplate->parse();
        }


        if ($_SERVER['REQUEST_METHOD']=="POST" && \Environment::get('isAjaxRequest')) {
            $this->myGenerateAjax();
            exit;
        }


        return parent::generate();
    }


    // Frontend
    protected function compile()
    {
        $arrIds = deserialize($this->colorSources,true);

        if(count($arrIds) < 1) {
            $this->Template->noResult = $GLOBALS['TL_LANG']['FE']['swatchBook']['noResult'];
        }
        else {
            $source = SwatchBookModel::findMultipleByIds($arrIds);

            while ($source->next()) {
                $arrSource[$source->id] = $source->title;
            }

            $this->Template->id             = $this->id;
            $this->Template->sources        = $arrSource;
            $this->Template->href           = $this->Environment->requestUri;
            $this->Template->countPalettes  = count($source);


            if(\Input::post('id')==NULL){
                reset($arrSource);
                $id = key($arrSource);
            }
            else {
                $id = \Input::post('id');
            }

            /* Load Colors */
            $objTemplate = new \FrontendTemplate('ce_swatchBookItems');
            $objElements = SwatchBookColorsModel::getColorList($id);
            while($objElements->next()){
                $childList[$objElements->id] = $objElements->title;
            }

            // Palette Message
            $paletteMsg = SwatchBookModel::getPaletteMessage($id);


            $objTemplate->id         = $id;
            $objTemplate->linkId     = $id;
            $objTemplate->child_list = $childList;
            $objTemplate->text       = $paletteMsg->text;
            $objTemplate->advice     = $paletteMsg->advice;
            $this->Template->colorsPalette = $objTemplate->parse();
        }

    }

    public function myGenerateAjax()
    {
        if(\Environment::get('isAjaxRequest') && \Input::post('id')) {

            $id                 = \Input::post('id');
            $objTemplate        =  new \FrontendTemplate('ce_swatchBookItems');
            $object             = SwatchBookColorsModel::getColorList($id);
            $paletteMsg         = SwatchBookModel::getPaletteMessage($id);


            while($object->next()){
                $arr[$object->id] = $object->title;
            }

            $objTemplate->id = $objTemplate->linkId = $id;
            $objTemplate->child_list                = $arr;
            $objTemplate->text                      = $paletteMsg->text;
            $objTemplate->advice                    = $paletteMsg->advice;
            $objTemplate->output();
        }
    }

}