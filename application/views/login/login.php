
<body class="hold-transition fondo">
<div class="login-box">
  <div class="login-logo">
<b>SISTEMA DE GASTOS REEMBOLSABLES</b> 
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form id="login" method="post" action="menu">
      <div class="form-group">
        <input type="text" id="txt_usuario" name="txt_usuario" class="form-control" placeholder="USUARIO">
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="txt_contra" name="txt_contra" class="form-control" placeholder="CONTRASEÑA">
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
		   <button id="btn_ini" name="btn_ini" type="submit" onclick="login();" class="form-control btn btn-primary">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  

</script>


</body>
</html>