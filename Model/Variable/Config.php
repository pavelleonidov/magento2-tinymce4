<?php
/*******************************************************************
 *  Copyright notice
 *
 *  (c) 2018 Pavel Leonidov <info@pavel-leonidov.de>
 *
 *  All rights reserved
 *
 *  This script is part of the Magento 2 project. The Magento 2 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as
 *  published by the Free Software Foundation; either version 2 of
 *  the License, or (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ******************************************************************/

namespace PavelLeonidov\TinyMce4\Model\Variable;


class Config extends \Magento\Variable\Model\Variable\Config {
	/**
	 * Return url to wysiwyg plugin
	 *
	 * @return string
	 * @codeCoverageIgnore
	 */
	public function getWysiwygJsPluginSrc()
	{
		$editorPluginJs = 'PavelLeonidov_TinyMce4/mage/adminhtml/wysiwyg/tiny_mce/plugins/magentovariable/editor_plugin.js';
		return $this->_assetRepo->getUrl($editorPluginJs);
	}
}
