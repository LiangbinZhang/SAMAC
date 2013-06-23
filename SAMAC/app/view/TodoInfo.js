/*
 * File: app/view/TodoInfo.js
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

Ext.define('TbTrack.view.TodoInfo', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.todoInfo',

    height: 343,
    itemId: '',
    layout: {
        align: 'center',
        type: 'vbox'
    },
    title: 'To-do Info',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            dockedItems: [
                {
                    xtype: 'form',
                    flex: 1,
                    dock: 'top',
                    frame: true,
                    height: 112,
                    layout: {
                        align: 'middle',
                        type: 'hbox'
                    },
                    bodyPadding: 10,
                    title: '',
                    dockedItems: [
                        {
                            xtype: 'container',
                            dock: 'left',
                            height: 219,
                            width: 398,
                            layout: {
                                align: 'center',
                                pack: 'center',
                                type: 'vbox'
                            },
                            items: [
                                {
                                    xtype: 'textfield',
                                    width: 237,
                                    fieldLabel: 'Name'
                                },
                                {
                                    xtype: 'datefield',
                                    fieldLabel: 'Creation Date'
                                },
                                {
                                    xtype: 'combobox',
                                    fieldLabel: 'Share'
                                }
                            ]
                        },
                        {
                            xtype: 'container',
                            dock: 'left',
                            height: 258,
                            width: 396,
                            layout: {
                                align: 'center',
                                pack: 'center',
                                type: 'vbox'
                            },
                            items: [
                                {
                                    xtype: 'datefield',
                                    fieldLabel: 'Deadline'
                                },
                                {
                                    xtype: 'combobox',
                                    fieldLabel: 'Priority'
                                },
                                {
                                    xtype: 'combobox',
                                    fieldLabel: 'Status'
                                }
                            ]
                        }
                    ]
                },
                {
                    xtype: 'form',
                    flex: 1,
                    dock: 'bottom',
                    frame: true,
                    height: 49,
                    width: 815,
                    bodyPadding: 10,
                    title: '',
                    dockedItems: [
                        {
                            xtype: 'container',
                            dock: 'right',
                            height: 40,
                            width: 208,
                            layout: {
                                align: 'middle',
                                pack: 'end',
                                type: 'hbox'
                            },
                            items: [
                                {
                                    xtype: 'button',
                                    flex: 1,
                                    width: 194,
                                    text: 'Create'
                                },
                                {
                                    xtype: 'splitter',
                                    width: 36
                                },
                                {
                                    xtype: 'button',
                                    flex: 1,
                                    width: 194,
                                    text: 'Cancel'
                                }
                            ]
                        }
                    ]
                }
            ],
            items: [
                {
                    xtype: 'textareafield',
                    flex: 1,
                    frame: true,
                    width: 1281,
                    hideLabel: true,
                    emptyText: 'Summary'
                }
            ]
        });

        me.callParent(arguments);
    }

});