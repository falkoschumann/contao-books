<?php

/**
 * Books Extension for Contao
 *
 * Copyright (c) 2012-2015 Falko Schumann
 *
 * @package Books
 * @link    https://github.com/falkoschumann/contao-books
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Muspellheim\Books;


/**
 * Base class with common functionality for rendering templates.
 *
 * This renderer based on \Module and \ContentElement.
 *
 * @copyright  Falko Schumann 2012-2015
 * @author     Falko Schumann <falko.schumann@muspellheim.de>
 * @package    Books
 */
abstract class Renderer extends \Frontend
{

	/**
	 * @var Model
	 */
	protected $objModel;

	/**
	 * @var string
	 */
	protected $strTemplate;

	/**
	 * @var array
	 */
	protected $arrData = array();


	/**
	 * @param \Model
	 */
	public function __construct($model)
	{
		if ($model instanceof \Model)
		{
			$this->objModel = $model;
		}
		elseif ($model instanceof \Model\Collection)
		{
			$this->objModel = $model->current();
		}

		parent::__construct();

		$this->arrData = $model->row();
	}


	/**
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		$this->arrData[$strKey] = $varValue;
	}


	/**
	 * @param string
	 * @return mixed
	 */
	public function __get($strKey)
	{
		if (isset($this->arrData[$strKey]))
		{
			return $this->arrData[$strKey];
		}

		return parent::__get($strKey);
	}


	/**
	 * @param string
	 * @return boolean
	 */
	public function __isset($strKey)
	{
		return isset($this->arrData[$strKey]);
	}


	/**
	 * @return string
	 */
	public function generateHtml()
	{
		if (TL_MODE == 'FE' && !BE_USER_LOGGED_IN && !$this->published)
		{
			return '';
		}

		$this->Template = new \FrontendTemplate($this->strTemplate);
		$this->Template->setData($this->arrData);

		$this->compileTemplate();

		return $this->Template->parse();
	}


	abstract protected function compileTemplate();

}
