# TinyMCE 4 WYSIWYG editor for Magento 2
 
The current Magento 2 core is still working with the legacy TinyMCE 3.x editor, with all its disadvantages. This module contains the current version of TinyMCE 4 and upgrades all editor related core dependencies to be fully compatible with the Magento 2 backend, including customized plugins for inserting/editing widgets and variables.

![](https://snag.gy/qQeU4t.jpg)

## Requirements

The TinyMCE 4 module is tested and working with Magento 2.1.x and Magento 2.2.x

## Installation

Via composer in the root directory of your Magento 2 installation:

```
composer config repositories.magento2-tinymce4 git git@github.com:pavelleonidov/magento2-tinymce4.git;
composer require pavelleonidov/module-tinymce4
php bin/magento setup:upgrade && php bin/magento setup:di:compile
```