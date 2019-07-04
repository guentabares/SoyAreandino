<?php require_once 'templates/header2.php';?>
<?php 
		try {
			$user_obj = new Cl_User();
			$data = $user_obj->list_account();
		} catch (Exception $e) {
			$error = $e->getMessage();
		} 
?>

	<div class="content">
     	<div class="container">
     		<div class="col-md-8 col-sm-8 col-xs-12">
     			<?php require_once 'templates/message.php';?>
     			<h3>Lista de Voluntarios</h3><br>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="account-form" method="post" class="form-horizontal myaccount" role="form">	
    <table data-role="table" id="my-table" data-mode="reflow">
      <thead>
        <tr>
          <th>Doc</th><th>&nbsp;</th><td>&nbsp;</td>
          <th>Nombre</th><th>&nbsp;</th><td>&nbsp;</td>
          <th>Tipo</th><th>&nbsp;</th><td>&nbsp;</td>          
          <th>Fecha Nac</th><th>&nbsp;</th><td>&nbsp;</td>
          <th>Email</th><th>&nbsp;</th><td>&nbsp;</td>
          <th>Celular</th><th>&nbsp;</th><td>&nbsp;</td>
          <th>Formación</th>
          <th>Disponibilidad</th>
        </tr>
      </thead>
      <tbody>

      	<?php
      	foreach($data as $item){
 		?>
        <tr>
          <td><?php echo $item['numdoc']; ?></td><td>&nbsp;</td><td>&nbsp;</td>
          <td><?php echo $item['nombre']; ?></td><td>&nbsp;</td><td>&nbsp;</td>
          <td><?php echo $item['tiposang']; ?></td><td>&nbsp;</td><td>&nbsp;</td>
          <td><?php echo $item['fechnac']; ?></td><td>&nbsp;</td><td>&nbsp;</td>
          <td><?php echo $item['email']; ?></td><td>&nbsp;</td><td>&nbsp;</td>
          <td><?php echo $item['celular']; ?></td><td>&nbsp;</td><td>&nbsp;</td>
          
          <td><?php
          if ($item['formacion']==1){
          	echo "Técnico";
          } else if ($item['formacion']==2){
          	echo "Tecnologo";
          }else if ($item['formacion']==3){
          	echo "Profesional";
          }else{
          	echo "Pogrado";
          }
		?></td>
		<td><?php 
		if($item['disponibilidad'] == 1){
		?>
			<a data-toggle="modal" data-target="#miModal" href="#miModal?var=<?php echo $item['id_preg']?>" class="list-group-item list-group-item-danger" >
			NO </a>
			<?php
		}else {
		?>
			<a data-toggle="modal" data-target="#miModal" href="#miModal?var=<?php echo $item['id_preg']?>" class="list-group-item list-group-item-success">
			SI </a>
		<?php
		}
		?>
		</td><td>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <?php 
    	}
        ?>
      </tbody>
    </table>
		</form>
		</div>
     		<?php require_once 'templates/sidebar.php';?>
     		
     	</div>
    </div> <!-- /container -->
<script src="js/jquery.validate.min.js"></script>
<script src="js/account.js"></script>    
<?php require_once 'templates/footer.php';?>
	

