Ext.define('TbTrack.controller.MainController', {
    extend: 'Ext.app.Controller',
    models: [
        'Projects',
        'ClientCompany'
    ],
    stores: [
        'Projects',
        'ClientCompany'
    ],
    views: [
        'Main',
        'ProjectListView',
        'TodoListView',
        'ProjectInfo',
        'Projects',
        'ClientListView',
        'NewProjectWindow',
        'NewClientCompanyWindow',
        'NewTodoWindow',
        'NewStaffWindow'
    ],
    refs: [
        {
            autoCreate: true,
            ref: 'main',
            selector: 'main',
            xtype: 'main'
        },
        {
            ref: 'contentView',
            selector: 'main #contentView'
        },
        {
            autoCreate: true,
            ref: 'projectListView',
            selector: 'projectListView',
            xtype: 'projectListView'
        },
        {
            autoCreate: true,
            ref: 'todoListView',
            selector: 'todoListView',
            xtype: 'todoListView'
        },
        {
            ref: 'projectCreationView',
            selector: 'projectCreationView'
        },
        {
            ref: 'todoCreationView',
            selector: 'todoCreationView'
        },
        {
            ref: 'clientCreationView',
            selector: 'clientCreationView'
        }
    ],
    projectListButtonClick: function(button, e, eOpts) {
        /*
         var win = Ext.create('widget.testWindow');
         win.show();
         */

        this.getContentView().getLayout().setActiveItem('project');
    },
    todoListButtonClick: function(button, e, eOpts) {
        this.getContentView().getLayout().setActiveItem('todoListView');
    },
    clientListButtonClick: function(button, e, eOpts) {
        this.getContentView().getLayout().setActiveItem('clientListView');
    },
    projectCreation: function(button, e, eOpts) {
        var win = Ext.create('widget.newProjectWindow');
        win.show();
        /*
         var test = Ext.ComponentQuery.query('#projectCreationButtonGroup')[1];
         test.disable = true;
         
         Ext.select("#projectCreationButtonGroup").hide();
         Ext.getCmp('projectCreationButtonGroup').hide();
         
         Ext.MessageBox.show({
         title: 'Address',
         msg: 'hello',
         width:300
         });
         
         */
    },
    todoCreation: function(button, e, eOpts) {
        var win = Ext.create('widget.newTodoWindow');
        win.show();
    },
    newClientCompanyCreation: function(button, e, eOpts) {
        var win = Ext.create('widget.newClientCompanyWindow');
        win.show();
    },
    newClientPersonCreation: function(button, e, eOpts) {
        var win = Ext.create('widget.newClientPersonWindow');
        win.show();
    },
    projectdbclick: function(dataview, record, item, index, e, eOpts) {
        this.getContentView().getLayout().setActiveItem('projectInfoView');
    },
    newStaffCreation: function(button, e, eOpts) {
        var win = Ext.create('widget.newStaffWindow');
        win.show();
    },
    onBoxReady: function() {
        Ext.getStore('Projects').load();
        Ext.getStore('ClientCompany').load();
    },
    init: function(application) {
        this.control({
            "main #projectListButton": {
                click: this.projectListButtonClick
            },
            "main #todoListButton": {
                click: this.todoListButtonClick
            },
            "main #clientListViewButton": {
                click: this.clientListButtonClick
            },
            "main #newProjectButton": {
                click: this.projectCreation
            },
            "main #newTodoButton": {
                click: this.todoCreation
            },
            "main #newClientCompanyButton": {
                click: this.newClientCompanyCreation
            },
            "main #newClientPersonButton": {
                click: this.newClientPersonCreation
            },
            "main #all_project": {
                itemdblclick: this.projectdbclick
            },
            "main #newStaffButton": {
                click: this.newStaffCreation
            },
            "main ": {
                boxready: this.onBoxReady
            }
        });
    }

});
