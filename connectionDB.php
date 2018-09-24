<?php 
	$myhost= "localhost";
    $mynamedb="lanchas";
    $myuserdb="root";
    $mypassdb="123456";

	class mysql {
	    var $conexion;
	    var $fechmode = PDO::FETCH_ASSOC;
	    var $error;
		var $sql_query;
	    var $sql_array;
		var $sql_row;


	    function Connect($driver, $user, $pass){
			try {
				$this->conexion = new PDO($driver.";charset=utf8", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

				/*
					PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass,
                    	array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                 */
			} catch (PDOException $e) {
				$this->error = $e->getMessage();
			}	
	        return $this->conexion;
	    }
		function ErrorInfo(){
			return $this->error;
		}
		
		function SetFetchMode($tipo){
			//FETCH_ASSOC o 	FETCH_NUM
			$this->fechmode = $tipo;
		}
		function Execute($sql,$array = NULL){
			$consulta = $this->conexion->prepare($sql);
			$consulta->setFetchMode($this->fechmode);
			$retorna = $consulta->execute($array);
			if(!$retorna){
				$errorinfo = $consulta->ErrorInfo();
				if(conf_debug){
				echo $errorinfo[2];
				}
			}else{
				$this->sql_query = $consulta;
				return $retorna;
			}
		}  
		
		function fetchrow(){
			return $this->sql_query->fetch();
		}
		function numrows(){
			return  $this->sql_query->rowCount();
		}
		function GetArray(){
			return $this->sql_query->fetchAll();
		}

	}

	
?>