/*
 * File: app/view/Projects.js
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

Ext.define('TbTrack.view.Projects', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.projects',

    requires: [
        'TbTrack.view.ProjectListView'
    ],

    height: 590,
    width: 787,

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'projectListView',
                    itemId: 'all_project',
                    store :'Projects',
                    title: 'All Project'
                },
                {
                    xtype: 'projectListView',
                    itemId: 'Eng_1st',
                    title: '1st Eng Project'
                },
                {
                    xtype: 'projectListView',
                    itemId: 'Eng_Current',
                    title: 'Curr Eng Project'
                }
            ]
        });

        me.callParent(arguments);
    }

});