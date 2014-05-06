{include file='AdminHead.tpl'}

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">                
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{$l_accountEditHead}</h1>

    </section>

    <!-- Main content -->
    <section class="content">
        {include file='AdminUserErrors.tpl'}
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{$l_accountinfoedit}</h3>
                    </div>
                    <form id="userDataEdit" method="POST" action="{$rootpatch}{$p_Admin}/{$c_AdminUser}/{$a_AdminDetailChange}" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="email">{$l_emailaddress}</label>
                                <input data-validate="email-ajax" data-validate-value="{$user.email}" type="text" name="emailaddress" class="form-control" id="email" value="{$user.email}" placeholder="{$l_emailaddress}">
                            </div>
                            <div class="form-group">
                                <label for="email">{$l_firstname}</label>
                                <input data-validate-range="3|50" type="text" name="firstname" class="form-control" id="firstname" value="{$user.first_name}" placeholder="{$l_firstname}">
                            </div>
                            <div class="form-group">
                                <label for="email">{$l_lastname}</label>
                                <input data-validate-range="3|50" type="text" name="lastname" class="form-control" id="email" value="{$user.last_name}" placeholder="{$l_lastname}">
                            </div>
                        </div><!-- /.box-body -->
                        <input type="hidden" id="csrftoken" name="csrftoken" value="{$formValidateToken}">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">{$l_savechanges}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{$l_changepassword}</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="userPasswordEdit" method="POST" action="{$rootpatch}{$p_Admin}/{$c_AdminUser}/{$a_AdminPasswordChange}" role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="oldpassword">{$l_oldpassword}</label>
                                <input data-validate-range="3|50" type="password" name="oldpassword" class="form-control" id="oldpassword" placeholder="{$l_oldpassword}">
                            </div>
                            <div class="form-group">
                                <label for="newpassword">{$l_newpassword}</label>
                                <input data-validate-range="3|50" type="password" name="newpassword" class="form-control" id="newpassword" data-validate-match="repeatnewpassword" placeholder="{$l_newpassword}">
                            </div>
                            <div class="form-group">
                                <label for="repeatnewpassword">{$l_repeatnewpassword}</label>
                                <input data-validate-range="3|50" data-validate-match="newpassword" type="password" name="repeatnewpassword" class="form-control" id="repeatnewpassword" placeholder="{$l_repeatnewpassword}">
                            </div>

                        </div><!-- /.box-body -->
                        <input type="hidden" id="csrftoken" name="csrftoken" value="{$formValidateToken}">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">{$l_savenewpassword}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

{include file='AdminFoot.tpl'}