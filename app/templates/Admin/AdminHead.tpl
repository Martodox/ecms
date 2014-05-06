<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{$siteTitle}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="{$packroot}css/normalize.css" rel="stylesheet" type="text/css" />

        <link href="{$packroot}css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link href="{$packroot}css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <link href="{$packroot}/css/ionicons.min.css" rel="stylesheet" type="text/css" />

        <link href="{$packroot}css/AdminLTE.css" rel="stylesheet" type="text/css" />
        {foreach from=$extraCSS item=css}
            <link href="{$css}" rel="stylesheet" type="text/css" />
        {/foreach}
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue fixed">
        <script>
            var rootpatch = "{$rootpatch}";
        </script>
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="{$rootpatch}{$p_Admin}" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                eCMS
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{$l_Hello}, {$user.first_name} {$user.last_name}! <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">

                                <li class="user-body">
                                    <div class="pull-left">
                                        <a href="{$rootpatch}{$p_Admin}/{$c_AdminUser}" class="btn btn-default btn-flat">{$l_EditAccount}</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{$rootpatch}{$p_Admin}/{$c_AdminAuth}/{$a_AdminLogOut}" class="btn btn-default btn-flat">{$l_logout}</a>
                                    </div>
                                </li>
                                <li class="user-footer bg-light-blue">
                                    <div class="text-center">
                                        <a href="{$rootpatch}">{$l_backtomainpage}</a>
                                    </div>

                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    {include file='AdminMenu.tpl'}
                </section>
                <!-- /.sidebar -->
            </aside>


