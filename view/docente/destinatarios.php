<div class="col-md-3">
 

    <!-- /.card -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Destinatarios</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-2">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item active">

        <select class="form-control form-control" id="sel_destinatario">
                                        <option>
                                            --Seleccione Destinatario--
                                        </option disabled>
                                        <option disabled>
                                            --Docentes--
                                        </option>
                                        <?php
                                          foreach ($allDestinatariosByDocenteId as $destinatario) {
                                                  echo "<option value='" . $destinatario['demail'] . "'>" . $destinatario['dnombre'] . " ".$destinatario['dapellido']." ".$destinatario['dapellido2']."</option>";
                                              }
                                              ?>

                                          <option disabled>
                                            --Personas de Contacto--
                                        </option> 
                                        <?php
                                          foreach ($allDestinatariosTutoresByDocenteId as $destinatario) {
                                                  echo "<option value='" . $destinatario['temail'] . "'>" . $destinatario['tnombre'] . " ".$destinatario['tapellido']." ".$destinatario['tapellido2']."</option>";
                                              }
                                              ?>
                                    </select>
        </li>

      </ul>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
