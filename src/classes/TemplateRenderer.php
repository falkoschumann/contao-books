<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2016 Falko Schumann
 *
 * @link    https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace Muspellheim\Books;


/**
 * Base class with common functionality for rendering templates.
 *
 * This renderer based on \Module and \ContentElement.
 *
 * @author Falko Schumann <falko.schumann@muspellheim.de>
 */
abstract class TemplateRenderer extends \Frontend
{

    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate;

    /**
     * Type.
     *
     * @var string
     */
    protected $type;


    /**
     * Model.
     *
     * @var Model
     */
    protected $objModel;


    /**
     * Current record.
     *
     * @var array
     */
    protected $arrData = array();


    /**
     * Initialize the object.
     *
     * @param \Model $objModel
     */
    public function __construct($objModel)
    {
        if ($objModel instanceof \Model) {
            $this->objModel = $objModel;
        } elseif ($objModel instanceof \Model\Collection) {
            $this->objModel = $objModel->current();
        }

        parent::__construct();

        $this->arrData = $objModel->row();
        $this->space = deserialize($objModel->space);
        $this->cssID = deserialize($objModel->cssID, true);
    }


    /**
     * Set an object property.
     *
     * @param string $strKey
     * @param mixed  $varValue
     */
    public function __set($strKey, $varValue)
    {
        $this->arrData[$strKey] = $varValue;
    }


    /**
     * Return an object property.
     *
     * @param string $strKey
     *
     * @return mixed
     */
    public function __get($strKey)
    {
        if (isset($this->arrData[$strKey])) {
            return $this->arrData[$strKey];
        }

        return parent::__get($strKey);
    }


    /**
     * Check whether a property is set.
     *
     * @param string $strKey
     *
     * @return boolean
     */
    public function __isset($strKey)
    {
        return isset($this->arrData[$strKey]);
    }


    /**
     * Return the model
     *
     * @return \Model
     */
    public function getModel()
    {
        return $this->objModel;
    }


    /**
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'FE' && !BE_USER_LOGGED_IN && !$this->published) {
            return '';
        }

        $this->Template = new \FrontendTemplate($this->strTemplate);
        $this->Template->setData($this->arrData);

        $this->compile();

        $this->Template->class = trim('books_' . $this->type . ' ' . $this->cssID[1]);
        $this->Template->cssID = ($this->cssID[0] != '') ? ' id="' . $this->cssID[0] . '"' : '';

        return $this->Template->parse();
    }


    abstract protected function compile();

}
