/*
 * File: app/view/NewClientCompany.js
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

Ext.define('TbTrack.view.NewClientCompany', {
    extend: 'Ext.window.Window',
    alias: 'widget.newClientCompany',

    height: 447,
    width: 731,
    layout: {
        align: 'center',
        type: 'vbox'
    },
    title: 'New Client Company',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            dockedItems: [
                {
                    xtype: 'form',
                    flex: 1,
                    dock: 'bottom',
                    frame: true,
                    height: 43,
                    width: 815,
                    bodyPadding: 10,
                    title: '',
                    dockedItems: [
                        {
                            xtype: 'container',
                            dock: 'right',
                            height: 40,
                            width: 225,
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
                                    width: 48
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
                },
                {
                    xtype: 'form',
                    flex: 1,
                    dock: 'top',
                    frame: true,
                    height: 208,
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
                            width: 351,
                            autoScroll: true,
                            layout: {
                                align: 'center',
                                pack: 'center',
                                type: 'vbox'
                            },
                            items: [
                                {
                                    xtype: 'combobox',
                                    width: 232,
                                    fieldLabel: 'Title'
                                },
                                {
                                    xtype: 'textfield',
                                    width: 233,
                                    fieldLabel: 'First Name'
                                },
                                {
                                    xtype: 'textfield',
                                    width: 233,
                                    fieldLabel: 'Last Name'
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Phone'
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Fax'
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Email'
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
                                    xtype: 'combobox',
                                    fieldLabel: 'Type'
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'P.O.'
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Street'
                                },
                                {
                                    xtype: 'textfield',
                                    width: 233,
                                    fieldLabel: 'City / Place'
                                },
                                {
                                    xtype: 'textfield',
                                    width: 233,
                                    fieldLabel: 'Province'
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Postal'
                                }
                            ]
                        }
                    ]
                }
            ],
            items: [
                {
                    xtype: 'textareafield',
                    frame: true,
                    height: 161,
                    width: 686,
                    hideLabel: true,
                    emptyText: 'Summary'
                }
            ]
        });

        me.callParent(arguments);
    }

});