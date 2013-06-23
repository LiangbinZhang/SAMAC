Ext.define('TbTrack.view.Main', {
    extend: 'Ext.container.Viewport',
    alias: 'widget.main',
    requires: [
        'TbTrack.view.Projects',
        'TbTrack.view.TodoListView',
        'TbTrack.view.ClientListView',
        'TbTrack.view.ProjectInfo'
    ],
    
    id: 'mainPanel',
    autoScroll: true,
    layout: {
        type: 'border'
    },
    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'image',
                    region: 'north',
                    height: 57,
                    src: 'samac.jpg'
                },
                {
                    xtype: 'panel',
                    region: 'west',
                    autoRender: false,
                    width: 122,
                    autoScroll: true,
                    layout: {
                        type: 'absolute'
                    },
                    collapseFirst: false,
                    collapsible: true,
                    manageHeight: false,
                    overlapHeader: false,
                    title: 'Nevigation',
                    items: [
                        {
                            xtype: 'button',
                            x: 10,
                            y: 60,
                            height: 30,
                            itemId: 'newProjectButton',
                            width: 100,
                            text: 'New Project'
                        },
                        {
                            xtype: 'button',
                            x: 10,
                            y: 210,
                            height: 30,
                            itemId: 'newStaffButton',
                            width: 100,
                            text: 'New Staff'
                        },
                        {
                            xtype: 'button',
                            x: 10,
                            y: 260,
                            height: 30,
                            width: 100,
                            text: 'Reports'
                        },
                        {
                            xtype: 'button',
                            x: 10,
                            y: 160,
                            height: 30,
                            itemId: 'newClientButton',
                            width: 100,
                            text: 'New Clients',
                            menu: {
                                xtype: 'menu',
                                items: [
                                    {
                                        xtype: 'menuitem',
                                        itemId: 'newClientCompanyButton',
                                        text: 'New Company'
                                    },
                                    {
                                        xtype: 'menuitem',
                                        itemId: 'newClientPersonButton',
                                        text: 'New Person'
                                    }
                                ]
                            }
                        },
                        {
                            xtype: 'button',
                            x: 10,
                            y: 110,
                            height: 30,
                            itemId: 'newTodoButton',
                            width: 100,
                            text: 'New To-do'
                        }
                    ]
                },
                {
                    xtype: 'container',
                    region: 'center',
                    id: 'subMainView',
                    layout: {
                        type: 'border'
                    },
                    items: [
                        {
                            xtype: 'panel',
                            region: 'north',
                            height: 68,
                            layout: {
                                type: 'absolute'
                            },
                            collapsible: true,
                            title: '',
                            items: [
                                {
                                    xtype: 'button',
                                    x: 15,
                                    y: 5,
                                    height: 30,
                                    id: '',
                                    itemId: 'projectListButton',
                                    width: 80,
                                    text: 'Project'
                                },
                                {
                                    xtype: 'button',
                                    x: 110,
                                    y: 5,
                                    height: 30,
                                    itemId: 'todoListButton',
                                    width: 80,
                                    text: 'To-do'
                                },
                                {
                                    xtype: 'button',
                                    x: 205,
                                    y: 5,
                                    height: 30,
                                    itemId: 'clientListViewButton',
                                    width: 80,
                                    text: 'Clients'
                                },
                                {
                                    xtype: 'button',
                                    x: 300,
                                    y: 5,
                                    height: 30,
                                    width: 80,
                                    text: 'Manage',
                                    menu: {
                                        xtype: 'menu',
                                        width: 120,
                                        items: [
                                            {
                                                xtype: 'menuitem',
                                                text: 'Staff'
                                            },
                                            {
                                                xtype: 'menuitem',
                                                text: 'Expense'
                                            },
                                            {
                                                xtype: 'menuitem',
                                                text: 'others'
                                            }
                                        ]
                                    }
                                },
                                {
                                    xtype: 'button',
                                    x: 790,
                                    y: 10,
                                    width: 70,
                                    text: 'Search'
                                },
                                {
                                    xtype: 'textfield',
                                    x: 510,
                                    y: 10,
                                    width: 270,
                                    fieldLabel: '',
                                    emptyText: 'Search'
                                },
                                {
                                    xtype: 'button',
                                    x: 870,
                                    y: 10,
                                    width: 70,
                                    text: 'Advanced'
                                },
                                {
                                    xtype: 'button',
                                    x: 395,
                                    y: 5,
                                    height: 30,
                                    width: 80,
                                    text: 'Help'
                                }
                            ]
                        },
                        {
                            xtype: 'container',
                            region: 'center',
                            id: 'contentView',
                            layout: {
                                type: 'card'
                            },
                            items: [
                                {
                                    xtype: 'projects',
                                    itemId: 'project',
                                    title: 'Project'
                                },
                                {
                                    xtype: 'todoListView',
                                    itemId: 'todoListView',
                                    title: 'To do'
                                },
                                {
                                    xtype: 'clientListView',
                                    itemId: 'clientListView'
                                },
                                {
                                    xtype: 'projectInfo',
                                    itemId: 'projectInfoView',
                                    title: 'Project Info'
                                }
                            ]
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});