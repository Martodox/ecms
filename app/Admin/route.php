<?php

App::route()->
        addComponent('AdminHome', 'pl', 'admin', 'en', 'admin')->
        addComponent('AdminAuth', 'pl', 'konto', 'en', 'account')->
        addComponent('AdminUser', 'pl', 'edytuj-konto', 'en', 'edit-account')->
        addComponent('AdminGallery', 'pl', 'admin-galeria', 'en', 'admin-gallery');
