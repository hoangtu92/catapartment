<?php
use Casperlaitw\LaravelFbMessenger\Messages\UrlButton;

// default locale must be required.
Menu::locale('default', function () {
    //Menu::postback('Test Button', 'TEST_POSTBACK');
    //Menu::webUrl('Google', 'http://google.com');

    /*Menu::nested('SubMenu', function () {
        Menu::postback('SubMenu-Button', 'TEST_SUB_BUTTON');
        Menu::webUrl(new UrlButton('SubMenu-WebUrl', 'http://google.com'));
    });*/
});

Menu::locale('zh_TW', function () {
    /*Menu::disableInput();
    Menu::postback('zh_TW Test Button', 'TEST_POSTBACK');
    Menu::postback('zh_TW Test Button', 'TEST_POSTBACK');
    Menu::postback('zh_TW Test Button', 'TEST_POSTBACK');*/
});
