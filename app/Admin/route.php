<?php

App::$route->
        addComponent(5, 'AdminHome', 'pl', 'admin-start', 'en', 'admin-home')->
        addComponent(5, 'AdminUser', 'pl', 'admin-edytuj-konto', 'en', 'admin-edit-account')->
        addComponent(5, 'AdminGallery', 'pl', 'admin-galeria', 'en', 'admin-gallery')->
        addComponent(5, 'AdminPages', 'pl', 'admin-strony-posty', 'en', 'admin-pages-posts')->
        addComponent(10, 'AdminSettings', 'pl', 'admin-ustawienia', 'en', 'admin-settings');
