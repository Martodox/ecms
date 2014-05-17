<?php

$globalRewrite = array(
    'pacage' => "Default",
    'component' => "Home",
    'action' => "",
    'file' => "",
    'vars' => array(),
    'access' => 0
);

if (!isset($_GET['get'])) {
    $_GET['get'] = "";
}

$link = explode('/', $_GET['get']);

for ($i = 0; $i <= 3; $i++) {
    if (!isset($link[$i])) {
        $link[$i] = "";
    }
}

foreach (App::$route->getRouteDialogs() as $key => $class) {
    App::$smarty->assign('l_' . $key, $class[$_SESSION['lang']], true);
}

  
if (!empty($link)) {

    $pacageSet = false;
    $componentSet = false;
    $actionSet = false;

    foreach (App::$route->getRoutePacage() as $key => $class) {

        if (in_array($link[0], $class)) {
            $globalRewrite['pacage'] = htmlspecialchars($key);
            $pacageSet = true;
            if (isset($class['access']) && is_int($class['access'])) {
                if ($globalRewrite['access'] < $class['access']) {
                    $globalRewrite['access'] = $class['access'];
                }
            }
        }
        App::$smarty->assign('p_' . $key, $class[$_SESSION['lang']], true);
    }
    $position = ($pacageSet ? 1 : 0);
    foreach (App::$route->getRouteComponents() as $key => $class) {
        if (in_array($link[$position], $class)) {
            $globalRewrite['component'] = htmlspecialchars($key);
            $componentSet = true;
            if (isset($class['access']) && is_int($class['access'])) {
                if ($globalRewrite['access'] < $class['access']) {
                    $globalRewrite['access'] = $class['access'];
                }
            }
        }
        App::$smarty->assign('c_' . $key, $class[$_SESSION['lang']], true);
    }

    foreach (App::$route->getRouteActions() as $filename => $file) {
        foreach ($file as $key => $action) {
            if (in_array($link[$position], $action) || in_array($link[$position + 1], $action)) {
                $globalRewrite['action'] = htmlspecialchars($key);
                $globalRewrite['file'] = htmlspecialchars($filename);
                $actionSet = true;
                if (isset($action['access']) && is_int($action['access'])) {
                    if ($globalRewrite['access'] < $action['access']) {
                        $globalRewrite['access'] = $action['access'];
                    }
                }
            }
            App::$smarty->assign('a_' . $key, $action[$_SESSION['lang']], true);
        }
    }
 
    if (!$componentSet) {
        $defaultComponent = $globalRewrite['pacage'] . $globalRewrite['component'];
        $defaultPremissions = App::$route->getRouteComponents($defaultComponent);
        $defaultPremissions['access'] = (!empty($defaultPremissions['access']) ? $defaultPremissions['access'] : 0);
        if ($globalRewrite['access'] < $defaultPremissions['access']) {
            $globalRewrite['access'] = $defaultPremissions['access'];
        }
        $globalRewrite['component'] = $defaultComponent;
    }
    if ($actionSet && $componentSet) {
        $globalRewrite['vars'] = explode(',', $link[$position + 2]);
    } else if (($actionSet && !$componentSet) || (!$actionSet && $componentSet)) {
        $globalRewrite['vars'] = explode(',', $link[$position + 1]);
    } else {
        if (!$actionSet && !$componentSet) {
            $globalRewrite['vars'] = explode(',', $link[$position + 0]);
        }
    }

    for ($i = 0; $i < count($globalRewrite['vars']) - 1; $i++) {
        $globalRewrite['vars'][$i] = htmlspecialchars($globalRewrite['vars'][$i]);
    }
}

App::$smarty->assign('g_vars', $globalRewrite['vars']);
App::$smarty->assign('rewrite', $globalRewrite);
$tmp = (empty($globalRewrite['vars']) ? false : true);
App::$smarty->assign('isVarSet', $tmp);
App::$route->setGlobalRewrite($globalRewrite);


