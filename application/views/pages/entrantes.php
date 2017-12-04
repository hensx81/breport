<!-- Mensajes -->
<?php print (validation_errors() != '') ? '
  <div class="alert alert-danger alert-dismissable" role="alert">
  <a href="#" class="close" data-dismiss="alert" aria-label="Cerrar">&times;</a>
    '. validation_errors().'
  </div>' : ''; ?>

<!-- Formulario -->
<?php print form_open('reportes/ver/entrantes'); ?>
  <div class="form-row">
    <div class="col-sm">
      <label for="fecha">Fecha:</label>
      <input type="date" class="form-control" id="fecha" name="fecha" value="<?php 
        if (set_value('fecha')) {
          echo set_value('fecha');
        }
        else {
          print date("Y-m-d");
        }
        ?>" aria-describedby="fecha">
      <small id="fecha" class="form-text text-muted">Ingrese la fecha de fin de la consulta.</small>
    </div>
    <div class="col-sm">
      <label for="fecha">Rango (Días):</label>
      <select class="form-control" id="rango" name="rango" aria-describedby="rango">
        <?php 
          for ( $i = 1; $i <= 31; $i++ ) { 
            echo '<option';
            if (set_value('rango') == $i) {
              echo " selected";
             }
            echo '>'.$i.'</option>'. PHP_EOL; 
          } 
        ?>
      </select>
      <small id="rango" class="form-text text-muted">Seleccione el rango de tiempo para generar el reporte.</small>
    </div>
    <div class="col-sm">
      <label for="origen">Origen:</label>
      <input type="text" class="form-control" id="origen" name="origen" value="<?php echo set_value('origen'); ?>" placeholder="escriba el número de origen">
    </div>
  </div>
  <div class="w-100"><hr></div>
  <button type="submit" value="ver" class="btn btn-primary">Ver</button>
  <button type="submit" value="descargar" class="btn btn-primary">Descargar</button>
</form>

<div class="w-100"><hr></div>

<!-- Reporte -->
<table class="table table-responsive table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Fecha</th>
      <th scope="col">CID</th>
      <th scope="col">Canal</th>
      <th scope="col">Origen</th>
      <th scope="col">Destino</th>
      <th scope="col">Duración</th>
      <th scope="col">Tarifa</th>
      <th scope="col">Costo</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($resultado as $row): ?>
    <tr>
	    <td><?php echo $row->uniqueid; ?></td>   
      <td><?php echo $row->calldate; ?></td>
      <td><?php echo $row->clid; ?></td>
      <td><?php echo $row->channel; ?></td>
      <td><?php echo $row->src; ?></td>
      <td><?php echo $row->dst; ?></td>
      <td><?php echo $row->billsec; ?></td>
      <td><?php echo "?" ?></td>
      <th scope="row"><?php echo $row->billsec/60*0.10; ?></th>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>