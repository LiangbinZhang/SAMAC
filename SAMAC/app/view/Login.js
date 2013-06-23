Ext.define('TbTrack.view.Login', {
    extend: 'Ext.container.Viewport',
    alias: 'widget.login',
    
    itemId: 'loginCheckButton',
    id: 'loginPanel',
    autoScroll: true,
    
    layout: {
        align: 'center',
        type: 'vbox'
    },
    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'image',
                    flex: 0,
                    height: 103,
                    width: 1293,
                    src: 'samac.jpg'
                },
                {
                    xtype: 'splitter',
                    height: 146,
                    maxHeight: 146
                },
                {
                    xtype: 'form',
                    height: 300,
                    width: 490,
                    autoScroll: true,
                    layout: {
                        type: 'absolute'
                    },
                    bodyPadding: 10,
                    title: 'Login',
                    items: [
                        {
                            id: 'usernameField',
                            xtype: 'textfield',
                            x: 50,
                            y: 60,
                            frame: false,
                            width: 365,
                            fieldLabel: 'Username',
                            name: 'username'
                        },
                        {
                            id: 'passwordField',
                            xtype: 'textfield',
                            x: 50,
                            y: 120,
                            width: 365,
                            fieldLabel: 'Password',
                            inputType: 'password',
                            name: 'password'
                        },
                        {
                            xtype: 'button',
                            x: 330,
                            y: 190,
                            height: 30,
                            width: 90,
                            text: 'Password?'
                        },
                        {
                            xtype: 'button',
                            x: 210,
                            y: 190,
                            height: 30,
                            itemId: 'loginButton',
                            width: 90,
                            text: 'Login'
                        }
                    ]
                }
            ]
        });

        me.callParent(arguments);
    }

});