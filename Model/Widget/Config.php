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

namespace PavelLeonidov\TinyMce4\Model\Widget;


class Config extends \Magento\Widget\Model\Widget\Config {
	/**
	 * Return config settings for widgets insertion plugin based on editor element config
	 *
	 * @param \Magento\Framework\DataObject $config
	 * @return array
	 */
	public function getPluginSettings($config)
	{
		$url = $this->_assetRepo->getUrl(
			'PavelLeonidov_TinyMce4/mage/adminhtml/wysiwyg/tiny_mce/plugins/magentowidget/editor_plugin.js'
		);
		$settings = [
			'widget_plugin_src' => $url,
			'widget_placeholders' => $this->_widgetFactory->create()->getPlaceholderImageUrls(),
			'widget_window_url' => $this->getWidgetWindowUrl($config),
		];

		return $settings;
	}
}
