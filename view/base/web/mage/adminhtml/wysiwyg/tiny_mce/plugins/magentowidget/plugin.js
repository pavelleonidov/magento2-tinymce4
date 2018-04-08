/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/* global tinyMCE, tinymce, widgetTools, Base64 */
/* eslint-disable strict */
tinyMCE.addI18n({
    en: {
        magentowidget: {
            'insert_widget': 'Insert Widget'
        }
    }
});

(function () {
    tinymce.create('tinymce.plugins.MagentowidgetPlugin', {
        /**
         * @param {tinymce.Editor} ed - Editor instance that the plugin is initialized in.
         * @param {String} url - Absolute URL to where the plugin is located.
         */
        init: function (ed, url) {
            ed.addCommand('mceMagentowidget', function () {
                widgetTools.openDialog(
                    ed.settings['magentowidget_url'] + 'widget_target_id/' + ed.getElement().id + '/'
                );
            });

            // Register Widget plugin button
            ed.addButton('magentowidget', {
                title: 'magentowidget.insert_widget',
                cmd: 'mceMagentowidget',
                image: url + '/img/icon.gif',
                onPostRender: function() {
                    var self = this;

                    // Add a node change handler, selects the button in the UI when a image is selected
                    ed.on("NodeChange", function (e) {
                        var widgetCode;

                        self.active(false);

                        if (e.target.id && e.target.nodeName == 'IMG') { //eslint-disable-line eqeqeq
                            widgetCode = Base64.idDecode(e.target.id);

                            if (widgetCode.indexOf('{{widget') !== -1) {
                                self.active(true);
                            }
                        }
                    });

                    ed.on('DblClick', function(e) {
                        var n = e.target,
                            widgetCode;

                        if (n.id && n.nodeName == 'IMG') { //eslint-disable-line eqeqeq
                            widgetCode = Base64.idDecode(n.id);
                            if (widgetCode.indexOf('{{widget') !== -1) {
                                self.execCommand('mceMagentowidget');
                            }
                        }
                    });
                }
            });



            // Add a widget placeholder image double click callback

            /*
            ed.onDblClick.add(function (edi, e) {
                var n = e.target,
                    widgetCode;

                if (n.id && n.nodeName == 'IMG') { //eslint-disable-line eqeqeq
                    widgetCode = Base64.idDecode(n.id);

                    if (widgetCode.indexOf('{{widget') !== -1) {
                        edi.execCommand('mceMagentowidget');
                    }
                }
            });*/


        },

        /**
         * @return {Object}
         */
        getInfo: function () {
            return {
                longname: 'Magento Widget Manager Plugin for TinyMCE 4.x',
                author: 'Magento Core Team, modified by Pavel Leonidov',
                authorurl: 'http://magentocommerce.com',
                infourl: 'http://magentocommerce.com',
                version: '1.0'
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('magentowidget', tinymce.plugins.MagentowidgetPlugin);
})();
