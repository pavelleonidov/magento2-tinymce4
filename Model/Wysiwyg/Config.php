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

namespace PavelLeonidov\TinyMce4\Model\Wysiwyg;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Ui\Component\Wysiwyg\ConfigInterface;

/**
 * Wysiwyg Config for Editor HTML Element
 */
class Config extends \Magento\Cms\Model\Wysiwyg\Config implements ConfigInterface
{

	/**
	 * Return Wysiwyg config as \Magento\Framework\DataObject
	 *
	 * Config options description:
	 *
	 * enabled:                 Enabled Visual Editor or not
	 * hidden:                  Show Visual Editor on page load or not
	 * use_container:           Wrap Editor contents into div or not
	 * no_display:              Hide Editor container or not (related to use_container)
	 * translator:              Helper to translate phrases in lib
	 * files_browser_*:         Files Browser (media, images) settings
	 * encode_directives:       Encode template directives with JS or not
	 *
	 * @param array|\Magento\Framework\DataObject $data Object constructor params to override default config values
	 * @return \Magento\Framework\DataObject
	 */
	public function getConfig($data = [])
	{
		$config = new \Magento\Framework\DataObject();

		$config->setData(
			[
				'enabled' => $this->isEnabled(),
				'hidden' => $this->isHidden(),
				'use_container' => false,
				'add_variables' => true,
				'add_widgets' => true,
				'no_display' => false,
				'encode_directives' => true,
				'baseStaticUrl' => $this->_assetRepo->getStaticViewFileContext()->getBaseUrl(),
				'baseStaticDefaultUrl' => str_replace('index.php/', '', $this->_backendUrl->getBaseUrl())
					. $this->filesystem->getUri(DirectoryList::STATIC_VIEW) . '/',
				'directives_url' => $this->_backendUrl->getUrl('cms/wysiwyg/directive'),

				'skin_url' => $this->_assetRepo->getUrl('PavelLeonidov_TinyMce4/lib/tinymce4/css/skins/lightgray'),

				'content_css' => $this->_assetRepo->getUrl('PavelLeonidov_TinyMce4/lib/tinymce4/css/skins/lightgray/content.min.css'),
				'width' => '500px',
				'height' => '500px',
				'plugins' => [],
			]
		);

		$config->setData('directives_url_quoted', preg_quote($config->getData('directives_url')));

		if ($this->_authorization->isAllowed('Magento_Cms::media_gallery')) {
			$config->addData(
				[
					'add_images' => true,
					'files_browser_window_url' => $this->_backendUrl->getUrl('cms/wysiwyg_images/index'),
					'files_browser_window_width' => $this->_windowSize['width'],
					'files_browser_window_height' => $this->_windowSize['height'],
				]
			);
		}

		if (is_array($data)) {
			$config->addData($data);
		}

		if ($config->getData('add_variables')) {
			$settings = $this->_variableConfig->getWysiwygPluginSettings($config);
			$config->addData($settings);
		}

		if ($config->getData('add_widgets')) {
			$settings = $this->_widgetConfig->getPluginSettings($config);
			$config->addData($settings);
		}

		return $config;
	}
}

?>