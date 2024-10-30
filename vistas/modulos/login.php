<div id="back"></div>

<div class="login-box">
  
  
  <div class="login-box-body">
  <div class="login-logo">

    <img src="vistas/img/plantilla/logo-V&RConstrucciones.jpeg" class="img-responsive"  style="height:250px;display:initial">
    
  </div>

    <h3 style="color:#6161f2;font-family:sans-serif;" class="text-center">Bienvenido</h3>
    <h4 class="box-title login-box-msg">Ingresa al sistema</h4>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" autofocus="autofocus" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      
      </div>

      <div class="row">
       
        <div class="col-xs-10 col-xs-offset-1">

          <button type="submit" class="btn btn-primary btn-block btn-flat"> <i class="fa fa-key" style="margin-right:10px"></i> Ingresar</button>
        
        </div>

        <div class="text-center help">
          <h5 id="problem" class="login" style="margin-top:50px;">¿Algún problema para iniciar sesión?</h5>
          <img src="vistas/img/plantilla/sistemaPOS.png" class="img-responsive"  style="margin-top:10px;width:150px;height:80px;display:initial">
        </div>

      </div>

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

  </div>

</div>
<style>
.login:hover{
color:blue;
text-decoration:underline;
cursor:pointer;
}
#fono{
  font-weight:bold;
}
</style>
<script>
$(".login").click(function(){
  $("#problem").hide();
  $(".help").append(
    '<p id="fono">Comunicarse al +56 9 7406 2227 o ayuda@mline.cl.</p>'
    );
})
</script>