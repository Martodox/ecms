<ul class="sidebar-menu">
    <li>
        <a href="{$rootpatch}{$p_Admin}">
            <i class="fa fa-dashboard"></i> <span>{$l_adminhomepage}</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-picture-o"></i>
            <span>{$l_gallery}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><a href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_listGalleryCategories}"><i class="fa fa-angle-double-right"></i> {$l_categorylist}</a></li>
            <li><a href="{$rootpatch}{$p_Admin}/{$c_AdminGallery}/{$a_chooseGalleryToUpload}"><i class="fa fa-angle-double-right"></i> {$l_pictureUpload}</a></li>            
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-wrench"></i> <span>{$l_admincustomercare}</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-user"></i>
            <span>{$l_adminyouraccount}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><a href="{$rootpatch}{$p_Admin}/{$c_AdminUser}"><i class="fa fa-angle-double-right"></i> {$l_admineditaccdetails}</a></li>
            <li><a href="{$rootpatch}{$p_Admin}/{$c_AdminUser}/{$a_allUserList}"><i class="fa fa-angle-double-right"></i> {$l_allUserList}</a></li>

            <li><a href="{$rootpatch}{$p_Admin}/{$c_AdminAuth}/{$a_AdminLogOut}"><i class="fa fa-angle-double-right"></i> {$l_logout}</a></li>
        </ul>
    </li>

</ul>