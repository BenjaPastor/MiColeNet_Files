<!--Menú-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand" href="/"><img src="<?php echo $infoFrontEnd['logo'] ?>" class="img-responsive" alt="logo">
</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
        <li><a href="/">Inicio</a></li>
          <li><a href="#caracteristicas"><?php echo $infoFrontEnd['menu1'] ?></a></li>
          <li><a href="#ventajas"><?php echo $infoFrontEnd['menu2'] ?></a></li>
          <li><a href="#panel"><?php echo $infoFrontEnd['menu3'] ?></a></li>
          <li><a href="#" data-target="#login" data-toggle="modal">Entrar</a></li>
          <li class="btn-trial"><a href="#footer">Contacto</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!--/ Menú-->