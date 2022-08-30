<?php
include_once "url.php";
include_once "Model/FrontEnd.php";
$frontEnd = new FrontEnd();
$infoFrontEnd = $frontEnd->infoFrontEnd();
?>
<!DOCTYPE html>
<html lang="en">

<?php
 include_once "view/template_layout/template_frontEnd/head.php";
 include_once "view/template_layout/template_frontEnd/header.php";

?>

<body class="fix-header fix-sidebar">
  <!--Banner-->
  <div class="banner">
    <div class="bg-color">
      <div class="container">
        <div class="row">
          <div class="banner-text text-center">
            <div class="text-border">
              <h2 class="text-dec"><?php echo $infoFrontEnd['slider_title'] ?></h2>
            </div>
            <div class="intro-para text-center quote">
              <p class="big-text"><?php echo $infoFrontEnd['slider_subtitle'] ?></p>
              <p class="small-text"><?php echo $infoFrontEnd['slider_texto'] ?></p>
              <a href="#footer" class="btn get-quote">CONTACTO</a>
            </div>
            <a href="#caracteristicas" class="mouse-hover">
              <div class="mouse"></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Banner-->
  <!--Seccion1-->
  <section id="caracteristicas" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2><?php echo $infoFrontEnd['menu1'] ?></h2>
          <p><?php echo $infoFrontEnd['menu1_subtitle'] ?></p>
          <hr class="bottom-line">
        </div>
        <div class="feature-info">
          <div class="fea">
            <div class="col-md-4">
              <div class="heading pull-right">
              <h4><?php echo $infoFrontEnd['menu1_icon1_title'] ?></h4>
                <p><?php echo $infoFrontEnd['menu1_icon1_text'] ?></p>
              </div>
              <div class="fea-img pull-left">
                <i class="<?php echo $infoFrontEnd['menu1_icon1'] ?>"></i>
              </div>
            </div>
          </div>
          <div class="fea">
            <div class="col-md-4">
              <div class="heading pull-right">
                <h4><?php echo $infoFrontEnd['menu1_icon2_title'] ?></h4>
                <p><?php echo $infoFrontEnd['menu1_icon2_text'] ?></p>
              </div>
              <div class="fea-img pull-left">
                <i class="<?php echo $infoFrontEnd['menu1_icon2'] ?>"></i>
              </div>
            </div>
          </div>
          <div class="fea">
            <div class="col-md-4">
              <div class="heading pull-right">
              <h4><?php echo $infoFrontEnd['menu1_icon3_title'] ?></h4>
                <p><?php echo $infoFrontEnd['menu1_icon3_text'] ?></p>
              </div>
              <div class="fea-img pull-left">
                <i class="<?php echo $infoFrontEnd['menu1_icon3'] ?>"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Seccion1-->
  <!--Seccion2-->
  <section id="ventajas" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="orga-stru">
              <h3><?php echo $infoFrontEnd['menu2_icon1_top'] ?></h3>
              <p><?php echo $infoFrontEnd['menu2_icon1_text'] ?></p>
              <i class="fa fa-exclamation"></i>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="orga-stru">
              <h3><?php echo $infoFrontEnd['menu2_icon2_top'] ?></h3>
              <p><?php echo $infoFrontEnd['menu2_icon2_text'] ?></p>
              <i class="fa fa-question "></i>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="orga-stru">
              <h3><?php echo $infoFrontEnd['menu2_icon3_top'] ?></h3>
              <p><?php echo $infoFrontEnd['menu2_icon3_text'] ?></p>
              <i class="fa fa-star fa-arrow-up"></i>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-info">
            <hgroup>
              <h3 class="det-txt"><?php echo $infoFrontEnd['menu2'] ?></h3>
              <h4 class="sm-txt"><?php echo $infoFrontEnd['menu2_subtitle'] ?></h4>
            </hgroup>
            <p class="det-p"><?php echo $infoFrontEnd['menu2_text'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Seccion2-->

  <!--Seccion3-->
  <section id="work-shop" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2>Dirección</h2>
          <p>Les presentamos nuestros miembros de Dirección.<br> Siempre dispuestos a ayudar.</p>
          <hr class="bottom-line">
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="service-box text-center">
            <div class="icon-box">
              <img src="<?php echo $infoFrontEnd['foto_direc1'] ?>" class="img-responsive" alt="planet">
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="service-box text-center">
            <div class="icon-box">
              <img src="<?php echo $infoFrontEnd['foto_direc2'] ?>" class="img-responsive" alt="lopedevega">

            </div>

          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="service-box text-center">
            <div class="icon-box">
              <img src="<?php echo $infoFrontEnd['foto_direc3'] ?>" class="img-responsive" alt="almedia">
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Seccion3-->

  <!--Testimonios-->
  <section id="testimonial" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2 class="white">¿Qué dicen nuestros usuarios?</h2>
          <p class="white">Testimonios reales de Padres y Madres reales.</p>
          <hr class="bottom-line bg-white">
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="text-comment">
            <p class="text-par"><?php echo $infoFrontEnd['testimonio1_text'] ?></p>
            <p class="text-name"><?php echo $infoFrontEnd['testimonio1'] ?></p>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="text-comment">
          <p class="text-par"><?php echo $infoFrontEnd['testimonio2_text'] ?></p>
            <p class="text-name"><?php echo $infoFrontEnd['testimonio2'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Testimonial-->
  <!--panel-->
  <section id="panel" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2><?php echo $infoFrontEnd['menu3'] ?></h2>
          <p><?php echo $infoFrontEnd['menu3_subtitle'] ?></p>
          <hr class="bottom-line">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6 padleft-right">
          <figure class="imghvr-fold-up">
            <img src="<?php echo $infoFrontEnd['menu3_1_img'] ?>" class="img-responsive" alt="course1">
            <figcaption>
              <h3><?php echo $infoFrontEnd['menu3_1_title'] ?></h3>
              <p><?php echo $infoFrontEnd['menu3_1_text'] ?></p>
            </figcaption>
            
          </figure>
        </div>
        <div class="col-md-4 col-sm-6 padleft-right">
          <figure class="imghvr-fold-up">
            <img src="<?php echo $infoFrontEnd['menu3_2_img'] ?>" class="img-responsive" alt="course2">
            <figcaption>
              <h3><?php echo $infoFrontEnd['menu3_2_title'] ?></h3>
              <p><?php echo $infoFrontEnd['menu3_2_text'] ?></p>
            </figcaption>
            
          </figure>
        </div>
        <div class="col-md-4 col-sm-6 padleft-right">
          <figure class="imghvr-fold-up">
            <img src="<?php echo $infoFrontEnd['menu3_3_img'] ?>" class="img-responsive" alt="course3">
            <figcaption>
              <h3><?php echo $infoFrontEnd['menu3_3_title'] ?></h3>
              <p><?php echo $infoFrontEnd['menu3_3_text'] ?></p>
            </figcaption>
            
          </figure>
        </div>
        
        
        
      </div>
    </div>
  </section>
  <!--/ panel-->

  <!--Contact-->
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2>Contacto</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem nesciunt vitae,<br> maiores, magni dolorum aliquam.</p>
          <hr class="bottom-line">
        </div>
        <div id="sendmessage">¡Su mensaje se ha mandado! </div>
        <div id="errormessage"></div>
        <form action="" method="post" role="form" class="contactForm" data-toggle="validator">
          <div class="col-md-6 col-sm-6 col-xs-12 left">
            <div class="form-group">
            <label for="name"></label>
              <input type="text" name="name" class="form-control form" id="name" placeholder="Su nombre" data-rule="minlen:3" data-msg="Mínimo 3 caracteres!" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
            <label for="email"></label>
              <input type="email" class="form-control" name="email" id="emailRemitente" placeholder="Su Email" data-rule="email" data-msg="Por favor, un email vÃ¡lido." />
              <div class="validation"></div>
            </div>
            <div class="form-group">
            <label for="subject"></label>
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:5" data-msg="5 caracteres mínimo para el asunto por favor" />
              <div class="validation"></div>
            </div>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 right">
            <div class="form-group">
            <label for="message"></label>

              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="¡Escribe algo!" placeholder="Mensaje"></textarea>
              <div class="validation"></div>
            </div>
          </div>

          <div class="col-xs-12">
            <!-- Button -->
            <button type="submit" id="submit" name="submit" class="form contact-form-button light-form-button oswald light">ENVIAR</button>
          </div>
        </form>

      </div>
    </div>
  </section>
  <!--/ Contact-->

 <?php  include_once "view/template_layout/template_frontEnd/footer.php";
?>


<!--Modal-->

 

<div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog modal-sm">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">Login</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
            <p class="login-box-msg">Introduzca sus credenciales para acceder al sistema</p>
            <div class="form-group">
              <form name="" id="loginForm" action="Controller/loginCtrl.php" method="post">
                <div class="form-group has-feedback">
                  <input class="form-control" placeholder="Email" id="email" name="email" type="text" autocomplete="off" />
                 

                </div>
                <div class="form-group has-feedback">
                  <input class="form-control" placeholder="Contraseña" id="pass" name="pass" type="password" autocomplete="off" />
            
                </div>

                <div class="form-group has-feedback">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="role" checked=checked value="Tutor" id="optionTutor">
                  <label class="form-check-label small font-weight-normal" for="role">Tutor, Padre/Madre</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="role" value="Docente" id="optionDocente">
                  <label class="form-check-label small font-weight-normal" for="role">Docente</label>
                </div>

              </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="checkbox icheck">
                      <label for="loginrem">
                                <input type="checkbox" id="loginrem" > Recordar
                              </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <button type="submit" class="btn btn-green btn-block btn-flat">Entrar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


<?php
  include_once'view/template_layout/template_frontEnd/script.php';?>

</body>
</html>
