<?php
namespace Blocks;

/**
 * Config service
 */
class ConfigService extends Component
{
	private $_tablePrefix;

	/**
	 * Get a config item
	 *
	 * @param      $item
	 * @param null $default
	 * @return null
	 */
	public function getItem($item, $default = null)
	{
		if (isset(b()->params['blocksConfig'][$item]))
			return b()->params['blocksConfig'][$item];

		return $default;
	}

	/**
	 * Adds config items to the mix of possible magic getter properties
	 *
	 * @param $name
	 * @return mixed|null
	 */
	function __get($name)
	{
		try
		{
			return parent::__get($name);
		}
		catch (\Exception $e)
		{
			return $this->getItem($name);
		}
	}

	/**
	 * Get a DB config item
	 *
	 * @param      $item
	 * @param null $default
	 * @return null
	 */
	public function getDbItem($item, $default = null)
	{
		if (isset(b()->params['dbConfig'][$item]))
			return b()->params['dbConfig'][$item];

		return $default;
	}

	/**
	 * @return mixed
	 */
	public function getTablePrefix()
	{
		if (!isset($this->_tablePrefix))
		{
			$tablePrefix = (string)$this->getDbItem('tablePrefix');
			if ($tablePrefix)
				$tablePrefix = rtrim($tablePrefix, '_').'_';
			$this->_tablePrefix = $tablePrefix;
		}

		return $this->_tablePrefix;
	}
}
