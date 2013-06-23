//@require @packageOverrides
Ext.Loader.setConfig({
    enabled: true
});

Ext.application({
    views: [
        'Login',
        'Main',
        'ProjectListView',
        'TodoListView',
        'ProjectInfo',
        'testWindow',
        'ClientListView',
        'NewProjectWindow',
        'NewClientCompanyWindow',
        'NewClientPersonWindow',
        'NewTodoWindow',
        'TodoInfoView',
        'ClientCompanyInfo',
        'StaffInfo',
        'NewStaffWindow'
    ],
    controllers: [
        'MainController',
        'LoginController'
    ],
    store: [
        'Projects',
        'ClientCompany'
    ],
    models: [
        'Projects',
        'ClientCompany'
    ],
    autoCreateViewport: true,
    name: 'TbTrack'
});
