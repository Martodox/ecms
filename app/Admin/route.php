<?php

App::$route->
        addComponent('AdminHome', 'pl', 'admin-start', 'en', 'admin-home')->
        addComponent('AdminAuth', 'pl', 'admin-konto', 'en', 'admin-account')->
        addComponent('AdminUser', 'pl', 'admin-edytuj-konto', 'en', 'admin-edit-account')->
        addComponent('AdminGallery', 'pl', 'admin-galeria', 'en', 'admin-gallery')->
        addComponent('AdminPages', 'pl', 'admin-strony-posty', 'en', 'admin-pages-posts');
