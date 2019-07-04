<?php
class Cl_Uservol
{
	/**
	 * @var va a contener la conexión de base de datos
	 */
	protected $_con;
	
	/**
	 * Inializar DBclass
	 */
	public function __construct()
	{
		$db = new Cl_DBclass();
		$this->_con = $db->con;
	}
	
	/**
	 * Registro de usuarios
	 * @param array $data
	  */
	public function registrar( array $data )
	{
		if( !empty( $data ) ){
			
			// Trim todos los datos entrantes:
			$trimmed_data = array_map('trim', $data);
			
			
			
			// escapar de las variables para la seguridad
			$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
			$tipdoc = mysqli_real_escape_string( $this->_con, $trimmed_data['tipdoc'] );
			$numdoc = mysqli_real_escape_string( $this->_con, $trimmed_data['ndoc'] );
			$tipsang = mysqli_real_escape_string( $this->_con, $trimmed_data['tsang'] );
			$genero = mysqli_real_escape_string( $this->_con, $trimmed_data['gen1'] );
			$fechnac = mysqli_real_escape_string( $this->_con, $trimmed_data['fcha'] );
			$eml = mysqli_real_escape_string( $this->_con, $trimmed_data['eml'] );
			$cell = mysqli_real_escape_string( $this->_con, $trimmed_data['cel'] );
			$formac = mysqli_real_escape_string( $this->_con, $trimmed_data['tipofor'] );

			echo "ver datos  nombre ".$name." TipoDoc ".$tipdoc." NumDoc ".$numdoc." Tipo Sangre ".$tipsang." Genero ".$genero." Fecha Nac ".$fechnac." Email ".$eml." Celular ".$cell." Formacion ".$formac;
			exit();
			
			// Verifica la direccion de correo electrónico:
		/*	if (filter_var( $trimmed_data['eml'], FILTER_VALIDATE_EMAIL)) {
				$email = mysqli_real_escape_string( $this->_con, $trimmed_data['eml']);
			} else {
				throw new Exception( "Por favor, introduce una dirección de correo electrónico válida!" );
			}
			
			$query = "INSERT INTO valuntario (id, nombre, tipodoc, numdoc, tiposang, genero, fechnac, email, celular, formacion) VALUES (NULL, '$name', '".$tipdoc."', '$numdoc', '".$tipsang."', '".$genero."', '$fechnac', '$eml', '$cell', '".$formac."')";
			//echo "ver datos ".$query;
	

			if(mysqli_query($this->_con, $query)){
				mysqli_close($this->_con);
				return true;
			};*/
		} else{
			throw new Exception( USER_REGISTRATION_FAIL );
		}
	}
}