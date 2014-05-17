<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>{$siteTitle} | {$l_loginText}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="{$temproot}Admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{$temproot}Admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{$temproot}Admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header">{$l_loginText}</div>
            <form action="{$rootpatch}{$p_Auth}/{$a_AdminLoginAuthorize}" method="post">
                <div class="body bg-gray">
                    {if $showloginerror}
                        <div class="alert alert-danger no-margin alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {$l_loginerrorinfo}
                        </div>
                    {/if}
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="{$l_emailplaceholder}" value="{if isset($wrongemail)}{$wrongemail}{/if}"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="{$l_password}"/>
                    </div>          
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">{$l_loginaction}</button>
                    <p><a href="{$rootpatch}{$p_Auth}/{$a_forgotPassword}">{$l_userforgotpassword}</a></p>
                    <a href="{$rootpatch}" class="text-center">{$l_backtomainpage}</a>
                </div>
                <input type="hidden" name="csrftoken" value="{$formValidateToken}">
            </form>
        </div>
        <!-- jQuery 2.0.2 -->
        <script src="{$temproot}js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{$temproot}js/bootstrap.min.js" type="text/javascript"></script>    
    </body>
</html>