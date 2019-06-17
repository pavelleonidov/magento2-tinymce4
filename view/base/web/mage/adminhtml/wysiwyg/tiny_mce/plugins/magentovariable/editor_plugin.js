/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/* global tinyMCE, tinymce, MagentovariablePlugin */
/* eslint-disable strict */
window.tinymce.addI18n({
    en: {
        magentovariable: {
            'insert_variable': 'Insert Variable'
        }
    }
});

(function () {
    tinymce.create('tinymce.plugins.MagentovariablePlugin', {
        /**
         * @param {tinymce.Editor} ed - Editor instance that the plugin is initialized in.
         * @param {String} url - Absolute URL to where the plugin is located.
         */
        init: function (ed, url) {
            ed.addCommand('mceMagentovariable', function () {
                var pluginSettings = ed.settings.magentoPluginsOptions.get('magentovariable');

                MagentovariablePlugin.setEditor(ed);
                MagentovariablePlugin.loadChooser(pluginSettings.url, null);
            });

            // Register Widget plugin button
            ed.addButton('magentovariable', {
                title: 'magentovariable.insert_variable',
                cmd: 'mceMagentovariable',
                image: url + '/img/icon.png'
            });
        },

        /**
         * @return {Object}
         */
        getInfo: function () {
            return {
                longname: 'Magento Variable Manager Plugin for TinyMCE 4.x',
                author: 'Magento Core Team, modified by Pavel Leonidov',
                authorurl: 'http://magentocommerce.com',
                infourl: 'http://magentocommerce.com',
                version: '1.0'
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('magentovariable', tinymce.plugins.MagentovariablePlugin);
})();
