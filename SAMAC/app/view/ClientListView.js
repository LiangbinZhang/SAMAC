/*
 * File: app/view/ClientListView.js
 *
 * This file was generated by Sencha Architect version 2.2.2.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 4.2.x library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 4.2.x. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('TbTrack.view.ClientListView', {
    extend: 'Ext.container.Container',
    alias: 'widget.clientListView',

    height: 636,
    width: 810,
    layout: {
        align: 'stretch',
        type: 'vbox'
    },

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'gridpanel',
                    height: 328,
                    width: 786,
                    autoScroll: true,
                    title: 'Company',
                    columnLines: true,
                    columns: [
                        {
                            xtype: 'rownumberer'
                        },
                        {
                            xtype: 'gridcolumn',
                            dataIndex: 'string',
                            text: 'Name'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'Type'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 93,
                            text: 'Phone'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 93,
                            text: 'Fax'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'Address'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'City'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 93,
                            text: 'Provice'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 93,
                            text: 'Postal'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 153,
                            text: 'Description'
                        }
                    ]
                },
                {
                    xtype: 'splitter'
                },
                {
                    xtype: 'gridpanel',
                    height: 594,
                    width: 786,
                    autoScroll: true,
                    title: 'Person',
                    columnLines: true,
                    columns: [
                        {
                            xtype: 'rownumberer'
                        },
                        {
                            xtype: 'gridcolumn',
                            dataIndex: 'string',
                            text: 'Title'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'Last Name'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'First Name'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'Direct Phone'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'Cell'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'Email'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'Home'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'Status'
                        },
                        {
                            xtype: 'gridcolumn',
                            text: 'Visible'
                        },
                        {
                            xtype: 'gridcolumn',
                            width: 429,
                            text: 'Notes'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});