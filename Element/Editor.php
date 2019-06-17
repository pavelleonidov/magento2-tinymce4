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

namespace PavelLeonidov\TinyMce4\Element;

use Magento\Framework\Escaper;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Data\Form\Element\CollectionFactory;

class Editor extends \Magento\Framework\Data\Form\Element\Editor
{



    /**
     * @return string
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function getElementHtml()
	{

		$preScript = '
			<script type="text/javascript">
            //<![CDATA[
                openEditorPopup = function(url, name, specs, parent) {
                    if ((typeof popups == "undefined") || popups[name] == undefined || popups[name].closed) {
                        if (typeof popups == "undefined") {
                            popups = new Array();
                        }
                        var opener = (parent != undefined ? parent : window);
                        popups[name] = opener.open(url, name, specs);
                    } else {
                        popups[name].focus();
                    }
                    return popups[name];
                }

                closeEditorPopup = function(name) {
                    if ((typeof popups != "undefined") && popups[name] != undefined && !popups[name].closed) {
                        popups[name].close();
                    }
                }
            //]]>
            </script>';

		if ($this->isEnabled()) {

			$jsSetupObject = 'wysiwyg' . $this->getHtmlId();

			$forceLoad = '';
			if (!$this->isHidden()) {
				if ($this->getForceLoad()) {
					$forceLoad = $jsSetupObject . '.setup("exact");';
				} else {
					$forceLoad = 'jQuery(window).on("load", ' .
						$jsSetupObject .
						'.setup.bind(' .
						$jsSetupObject .
						', "exact"));';
				}
			}

			$textarea = $this->_getButtonsHtml() .
				'<textarea
					name="' . $this->getName() . '"
					title="' . $this->getTitle() . '"
					' . $this->_getUiId() . '
					id="' . $this->getHtmlId() . '"' . '
					class="textarea' . $this->getClass() . '"
					' . $this->serialize($this->getHtmlAttributes()) . ' >' .
				$this->getEscapedValue() .
				'</textarea>' . $preScript;

			$config = \Zend_Json::encode($this->getConfig());

			$script = '
				<script type="text/javascript">
					//<![CDATA[
					 window.tinymce = window.tinymce || {}; 
					 window.tinymce.loaded = true;
					 require(["jquery", "mage/translate", "mage/adminhtml/events", "mage/adminhtml/wysiwyg/tiny_mce/setup", "mage/adminhtml/wysiwyg/widget"], function(jQuery){
						(function($) {$.mage.translate.add(' .
						\Zend_Json::encode(
							$this->getButtonTranslations()
						) .
						')})(jQuery);'
						. $jsSetupObject . ' = new tinyMceWysiwygSetup("' . $this->getHtmlId() . '", ' . $config .
							');' .
							$forceLoad .
							'
							editorFormValidationHandler = ' .
							$jsSetupObject .
							'.onFormValidation.bind(' .
							$jsSetupObject .
							');
								Event.observe("toggle' .
							$this->getHtmlId() .
							'", "click", ' .
							$jsSetupObject .
							'.toggle.bind(' .
							$jsSetupObject .
							'));
								varienGlobalEvents.attachEventHandler("formSubmit", editorFormValidationHandler);
								varienGlobalEvents.clearEventHandlers("open_browser_callback");
								varienGlobalEvents.attachEventHandler("open_browser_callback", ' .
							$jsSetupObject .
							'.openFileBrowser);
							//]]>
							});			
					
				</script>
			';

			$html = $this->_wrapIntoContainer($textarea . $script);

			$html .= $this->getAfterElementHtml();

			return $html;
		} else {
			// Display only buttons to additional features
			if ($this->getConfig('widget_window_url')) {
				$html = $this->_getButtonsHtml() . $preScript . parent::getElementHtml();
				if ($this->getConfig('add_widgets')) {
					$html .= '<script type="text/javascript">
                    //<![CDATA[
                    require(["jquery", "mage/translate", "PavelLeonidov_TinyMce4/mage/adminhtml/wysiwyg/widget"], function(jQuery){
                        (function($) {
                            $.mage.translate.add(' . \Zend_Json::encode($this->getButtonTranslations()) . ')
                        })(jQuery);
                    });
                    //]]>
                    </script>';
				}
				$html = $this->_wrapIntoContainer($html);
				return $html;
			}
			return parent::getElementHtml();
		}
	}

}
