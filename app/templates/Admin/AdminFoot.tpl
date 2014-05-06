</div><!-- ./wrapper -->


<!-- jQuery 2.0.2 -->
<script src="{$temproot}js/jquery-2.1.0.min.js"></script>
<!-- Bootstrap -->
<script src="{$temproot}js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{$temproot}js/AdminLTE/app.js" type="text/javascript"></script>
{foreach from=$extraJS item=js}
    <script src="{$js}" type="text/javascript"></script>
{/foreach}

</body>
</html>