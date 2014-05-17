<?php

App::$route->
        addDialog('AdminAuth', 'pl', 'Autoryzacja użytkownika')->
        addDialog('loginInfo', 'pl', 'Witaj w panelu administracyjnym. Nie jesteś zalogowany. Wprowadź swoje dane dostępowe aby przejść dalej')->
        addDialog('loginText', 'pl', 'Logowanie')->
        addDialog('password', 'pl', 'hasło')->
        addDialog('backtomainpage', 'pl', 'Powrót do strony głównej')->
        addDialog('loginaction', 'pl', 'Zaloguj się!', 'en', 'Sign me in!')->
        addDialog('emailplaceholder', 'pl', 'adres@email.pl')->
        addDialog('userforgotpassword', 'pl', 'Przypomnij hasło', 'en', 'I forgot my password')->
        addDialog('loginerrorinfo', 'pl', 'Błędny login i/lub hasło. Spróbuj ponownie.');
