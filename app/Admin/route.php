<?php

App::$route->
        addComponent('AdminHome', 'pl', 'admin-start', 'en', 'admin-home')->
        addComponent('AdminAuth', 'pl', 'konto', 'en', 'account')->
        addComponent('AdminUser', 'pl', 'edytuj-konto', 'en', 'edit-account')->
        addComponent('AdminGallery', 'pl', 'admin-galeria', 'en', 'admin-gallery');
