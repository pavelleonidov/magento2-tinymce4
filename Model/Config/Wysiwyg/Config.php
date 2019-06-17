<?php
/*******************************************************************
 *  Copyright notice
 *
 *  (c) 2018 Pavel Leonidov <pavel.leonidov@exconcept.com>, EXCONCEPT GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
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

declare(strict_types=1);

namespace PavelLeonidov\TinyMce4\Model\Config\Wysiwyg;

/**
 * Additional plugins for the TinyMce 4 editor
 */
class Config implements \Magento\Framework\Data\Wysiwyg\ConfigProviderInterface
{
	/**
	 * @var \Magento\Framework\View\Asset\Repository
	 */
	private $assetRepo;

	/**
	 * @param \Magento\Framework\View\Asset\Repository $assetRepo
	 */
	public function __construct(
		\Magento\Framework\View\Asset\Repository $assetRepo
	) {
		$this->assetRepo = $assetRepo;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getConfig(\Magento\Framework\DataObject $config) : \Magento\Framework\DataObject
	{
		$config->addData([
			'tinymce4' => [
				'toolbar' => 'styleselect | bold italic | forecolor backcolor | undo redo | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | fullscreen',
				'plugins' => 'advlist autolink lists link image charmap print preview hr anchor pagebreak
							  searchreplace wordcount visualblocks visualchars code fullscreen
							  insertdatetime media nonbreaking save table contextmenu directionality
				              emoticons template paste textcolor colorpicker textpattern imagetools autoresize'
			]
		]);

		return $config;
	}
}
