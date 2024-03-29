<?php
class Cl_User
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
	public function registration( array $data )
	{
		if( !empty( $data ) ){
			
			// Trim todos los datos entrantes:
			$trimmed_data = array_map('trim', $data);
			
			
			
			// escapar de las variables para la seguridad
			$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			$cpassword = mysqli_real_escape_string( $this->_con, $trimmed_data['confirm_password'] );
			
			
			// Verifica la direccion de correo electrónico:
			if (filter_var( $trimmed_data['email'], FILTER_VALIDATE_EMAIL)) {
				$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email']);
			} else {
				throw new Exception( "Por favor, introduce una dirección de correo electrónico válida!" );
			}
			
			
			if((!$name) || (!$email) || (!$password) || (!$cpassword) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = md5( $password );
			$query = "INSERT INTO users (user_id, name, email, password, created) VALUES (NULL, '$name', '$email', '$password', CURRENT_TIMESTAMP)";
			if(mysqli_query($this->_con, $query)){
				mysqli_close($this->_con);
				return true;
			};
		} else{
			throw new Exception( USER_REGISTRATION_FAIL );
		}
	}

	/**
	 * Registro de usuarios
	 * @param array $data
	  */
	public function registration2( array $data )
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
			$dispo = mysqli_real_escape_string( $this->_con, $trimmed_data['disp'] );
			$range = mysqli_real_escape_string( $this->_con, $trimmed_data['rango'] );
			$dir = mysqli_real_escape_string( $this->_con, $trimmed_data['dirc'] );
			$ciud = mysqli_real_escape_string( $this->_con, $trimmed_data['ciud'] );
			$paiss = mysqli_real_escape_string( $this->_con, $trimmed_data['pais'] );
			$tipuser = mysqli_real_escape_string( $this->_con, $trimmed_data['tipouser'] );

			// Verifica la direccion de correo electrónico:
			if (filter_var( $trimmed_data['eml'], FILTER_VALIDATE_EMAIL)) {
				$email = mysqli_real_escape_string( $this->_con, $trimmed_data['eml']);
			} else {
				throw new Exception( "Por favor, introduce una dirección de correo electrónico válida!" );
			}
			
			$query = "INSERT INTO valuntario (id, nombre, tipodoc, numdoc, tiposang, genero, fechnac, email, celular, formacion, disponibilidad, rango, direccion, ciudad, pais, tipouser ) VALUES (NULL, '$name', '".$tipdoc."', '$numdoc', '".$tipsang."', '".$genero."', '$fechnac', '$eml', '$cell', '".$formac."', '".$dispo."', '".$range."', '".$dir."','".$ciud."', '".$paiss."','".$tipuser."' )";
			$query2 = "INSERT INTO google_maps_php_mysql (id, nombre, direccion, pais, disponibilidad) VALUES (NULL,'$name', '".$dir."','".$paiss."','".$dispo."')";

			if(mysqli_query($this->_con, $query)){
				mysqli_query($this->_con, $query2);

				mysqli_close($this->_con);
				return true;
			};

		} else{
			throw new Exception( USER_REGISTRATION_FAIL );
		}
	}

	/**
	 * Este metodo para iniciar sesión
	 * @param array $data
	 * @return retorna falso o verdadero
	 */
	public function login( array $data )
	{
		$_SESSION['logged_in'] = false;
		if( !empty( $data ) ){
			
			// Trim todos los datos entrantes:
			$trimmed_data = array_map('trim', $data);
			
			// escapar de las variables para la seguridad
			$email = mysqli_real_escape_string( $this->_con,  $trimmed_data['email'] );
			$password = mysqli_real_escape_string( $this->_con,  $trimmed_data['password'] );
				
			if((!$email) || (!$password) ) {
				throw new Exception( LOGIN_FIELDS_MISSING );
			}
			$password = md5( $password );
			$query = "SELECT user_id, name, email, created FROM users where email = '$email' and password = '$password' ";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			mysqli_close($this->_con);
			if( $count == 1){
				$_SESSION = $data;
				$_SESSION['logged_in'] = true;
				return true;
			}else{
				throw new Exception( LOGIN_FAIL );
			}
		} else{
			throw new Exception( LOGIN_FIELDS_MISSING );
		}
	}
	
	/**
	 * El siguiente metodo para verificar los datos de la cuenta para el cambio de contraseña
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */
	
	
		public function list_account(){

			$query = "SELECT numdoc, nombre, tiposang, fechnac, email, celular, formacion, disponibilidad, tipouser FROM valuntario";
			$result = mysqli_query($this->_con, $query);

			while ($row = mysqli_fetch_assoc($result)){
				$data[] = $row;
			}			
			return $data;
			mysqli_close($this->_con);			
		}


	public function account( array $data )
	{
		if( !empty( $data ) ){
			// Trim todos los datos entrantes:
			$trimmed_data = array_map('trim', $data);
			
			// escapar de las variables para la seguridad
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			$cpassword = $trimmed_data['confirm_password'];
			$user_id = mysqli_real_escape_string( $this->_con, $trimmed_data['user_id'] );
			
			if((!$password) || (!$cpassword) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = md5( $password );
			$query = "UPDATE users SET password = '$password' WHERE user_id = '$user_id'";
			if(mysqli_query($this->_con, $query)){
				mysqli_close($this->_con);
				return true;
			}
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}
	
	/**
	 * Este metodo para cerrar las sesión
	 */
	public function logout()
	{
		session_unset();
		session_destroy();
		header('Location: index.php');
	}
	
	/**
	 * Esto restablece la contraseña actual y la nueva contraseña para enviar correo
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */
	public function forgetPassword( array $data )
	{
		if( !empty( $data ) ){
			
			// escapar de las variables para la seguridad
			$email = mysqli_real_escape_string( $this->_con, trim( $data['email'] ) );
			
			if((!$email) ) {
				throw new Exception( FIELDS_MISSING );
			}
			$password = $this->randomPassword();
			$password1 = md5( $password );
			$query = "UPDATE users SET password = '$password1' WHERE email = '$email'";
			if(mysqli_query($this->_con, $query)){
				mysqli_close($this->_con);
				$to = $email;
				$subject = "Nueva solicitud de contraseña";
				$txt = "Su nueva contraseña ".$password;
				$headers = "From: admin@obedalvarado.pw" . "\r\n" .
						"CC: admin@obedalvarado.pw";
					
				mail($to,$subject,$txt,$headers);
				return true;
			}
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}
	
	/**
	 * Esto generará una contraseña aleatoria
	 * @return string
	 */
	
	private function randomPassword() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //recuerde que debe declarar $pass como un array
		$alphaLength = strlen($alphabet) - 1; //poner la longitud -1 en caché
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //convertir el array en una cadena
	}

}