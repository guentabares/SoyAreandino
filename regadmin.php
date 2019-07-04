<?php require_once 'templates/header2.php';?>
<?php 
	if(!empty($_POST)){
		try {
			$user_reg = new Cl_User();
			$data = $user_reg->registration2( $_POST );
			if($data)$success = USER_REGISTRATION_SUCCESS;
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}
?>
	<div class="content">
     	<div class="container">
     		<div class="col-md-8 col-sm-8 col-xs-12">
     			<?php require_once 'templates/message.php';?>
     			<h3>Mi Perfil:</h3><br>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="account-form" method="post" class="form-horizontal myaccount" role="form">
					<div class="form-group">
						<input name="name" id="name" type="text" class="form-control" placeholder="Nombres"> 
						<span class="help-block"></span>
					</div>
					<div data-role="fieldcontain">
   					<label for="tiposuscripcion">Tipo Documento </label>
   						<select name="tipdoc" id="tipofor">
      					<option value="1">CC</option>
      					<option value="2">TI</option>      					
   						</select>
					</div>
					<div class="form-group">
						<input name="ndoc" id="ndoc" type="text" class="form-control" placeholder="Numero Documento"> 
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<input name="dirc" id="dirc" type="text" class="form-control" placeholder="Dirección"> 
						<span class="help-block"></span>
					</div>

					<div class="form-group">
						<input name="ciud" id="ciud" type="text" class="form-control" placeholder="Ciudad"> 
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<input name="pais" id="pais" type="text" class="form-control" placeholder="Pais"> 
						<span class="help-block"></span>
					</div>

					
				
					<div data-role="fieldcontain">
   					<label for="tiposuscripcion">Tipo de Sangre</label>
   						<select name="tsang" id="tsang">
      					<option value="1">O-</option>
      					<option value="2">O+</option>
      					<option value="3">A-</option>
      					<option value="4">A+</option>
      					<option value="5">B-</option>
      					<option value="6">B+</option>
      					<option value="7">AB-</option>
      					<option value="8">AB+</option>
   						</select>
					</div>
					<div data-role="fieldcontain">
    				<fieldset data-role="controlgroup">
        				<legend>Genero</legend>
            				<input type="radio" name="gen1" id="radio-choice-1" value="0" checked="checked" />
            				<label for="radio-choice-1">Masculino</label>
 
            				<input type="radio" name="gen1" id="radio-choice-2" value="1"  />
            				<label for="radio-choice-2">Femenino</label>             				
    					</fieldset>
					</div>
					<div class="form-group">
						<input name="fcha" id="fcha" type="text" class="form-control" placeholder="Fecha Nacimiento"> 
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<input name="eml" id="eml" type="text" class="form-control" placeholder="Email"> 
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<input name="cel" id="cel" type="text" class="form-control" placeholder="Celular"> 
						<span class="help-block"></span>
					</div>					
					<div data-role="fieldcontain">
   					<label for="tiposuscripcion">Formación</label>
   						<select name="tipofor" id="tipofor">
      					<option value="1">Técnico</option>
      					<option value="2">Tecnologo</option>
      					<option value="3">Profesional</option>
      					<option value="4">Posgrado</option>
   						</select>
					</div>					
					<label for="flip-1">Disponibilidad</label>
						<select name="disp" id="flip-1" data-role="slider">
						<option value="1">No</option>
						<option value="2">Si</option>
					</select>
					<label for="slider-fill"/>Rango:</label>
					<input type="range" name="rango" id="slider-fill" value="4" min="0" max="12" data-highlight="true"/>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<button type="submit" class="btn btn-default" id="submit_btn" data-loading-text="Restigrar....">Registrar</button>
						</div>
					</div>
				</form>
		</div>
     		<?php require_once 'templates/sidebar.php';?>
     		
     	</div>
    </div> <!-- /container -->
<script src="js/jquery.validate.min.js"></script>
<script src="js/account.js"></script>    
<?php require_once 'templates/footer.php';?>
	

