# TinyMCE 4 WYSIWYG editor for Magento 2
 
The Magento 2 versions up to 2.2.* implement the legacy TinyMCE 3.x editor, with all its disadvantages. This module contains the current version of TinyMCE 4 for all major Magento 2 versions and upgrades all editor related core dependencies to be fully compatible with the Magento 2 backend and frontend, including customized plugins for inserting/editing widgets and variables. The Magento 2 versions up to 2.2 are supported by this module up to module version 1.0.*.

For Magento 2.3: The new major releases include TinyMCE 4 in its core. However, it faces some issues when using in production mode and also, the core implementation is limited in its selection of editor plugins. This module fixes the issues for using in production context and extends the plugin selection as well. Version 2.0.0 of this module and upwards supports Magento 2.3. 

Also, the editor is configured to extend the schema of allowed HTML tags (useful if you're using the product description for multichannel rollouts with e. g. M2ePro).

![](https://snag.gy/Udn5RS.jpg)

## Requirements

The TinyMCE 4 module is tested and working with Magento 2.1.x, Magento 2.2.x and Magento 2.3.x.

## Installation

Via composer in the root directory of your Magento 2 installation:

```
composer require pavelleonidov/module-tinymce4
php bin/magento setup:upgrade && php bin/magento setup:di:compile
```

### Note:
The dev-master branch is compatible with Magento 2.3.x only. If you want to use this module for Magento 2.2 and lower, use the tagged version 1.0.x (same procedure as above, just don't use e. g. `composer require pavelleonidov/module-tinymce4:dev-master`)
