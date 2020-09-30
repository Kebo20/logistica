<?php
   require_once('conexion.php');
   
   class Usuarios{
	   
    function Listar($nombre){
	  $ocado=new cado();
	  $sql="select * from usuario where nombre like '%$nombre%' order by id desc";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	}
	function ListarGrupo($nombre){
	  $ocado=new cado();
	  $sql="select * from usuario_grupo where nombre like '%$nombre%' order by id desc";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	}
	function ValidarUsuario($user){
	  $ocado=new cado();
	  $sql="select count(*) from usuario where user='$user'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function ValidarGrupo($nombre){
	  $ocado=new cado();
	  $sql="select count(*) from usuario_grupo where nombre='$nombre'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	 }
	 function Registrar($usuario,$login,$pass,$estado,$tipo){
		  $ocado=new cado();
          $sql="insert into usuario(nombre,user,pass,estado,id_grupo_usu,user_activo) 
                values('$usuario','$login','$pass','$estado','$tipo',0)";
		  $ejecutar=$ocado->ejecutar($sql);
		  return $ejecutar;
	 }
	 function RegistrarGrupo($nombre,$tip){
		  $ocado=new cado();
          $sql="insert into usuario_grupo(nombre,vista) 
                values('$nombre','$tip')";
		  $ejecutar=$ocado->ejecutar($sql);
		  return $ejecutar;
	 }
	  
	 
	 function Modificar($id,$usuario,$login,$pass,$estado,$idgrupo_usu){
		  $ocado=new cado();
		  $sql="update usuario set nombre = '$usuario',user='$login',pass='$pass', estado=$estado,
		          id_grupo_usu='$idgrupo_usu'
		        where id = $id";
		  $ejecutar=$ocado->ejecutar($sql);
		  return $ejecutar;
	 }	
	 function ModificarGrupo($id,$nombre,$tip){
		  $ocado=new cado();
		  $sql="update usuario_grupo set nombre = '$nombre', vista='$tip' 
		        where id = $id";
		  $ejecutar=$ocado->ejecutar($sql);
		  return $ejecutar;
	 } 
	 	 
	 function Eliminar($id){
		$ocado=new cado();
		$sql="delete from usuario where id = $id";
		$ejecutar=$ocado->ejecutar($sql);
		return $ejecutar;
	 } 
	 function Acceso($user,$pass){
		$ocado=new cado();
		$sql="select u.*,ca.nom_caja,c.codigo_ingreso,ca.id idcaja,g.nombre nom_grupo from usuario u left join caja_fondos c on u.id=c.id_user and c.activo=1
		                                      left join caja ca on c.id_caja=ca.id 
											  inner join usuario_grupo g on u.id_grupo_usu=g.id
		     where md5(u.user)='$user' and u.pass='$pass' and u.estado=0";
		$ejecutar=$ocado->ejecutar($sql);
		return $ejecutar;
	 }
	 function AccesoEmpresa($user,$pass){
		$ocado=new cado();
		$sql="select empresa,ruc from convenio
		     where md5(ruc)='$user' and pass='$pass' and tipo='C' ";
		$ejecutar=$ocado->ejecutar($sql);
		return $ejecutar;
	 }
	 function AccesoPaciente($user,$pass){
		$ocado=new cado();
		$sql="select concat(ape_pat,' ',ape_mat,' ',preNombres)pac,dni from paciente
		     where md5(dni)='$user' and pass='$pass' ";
		$ejecutar=$ocado->ejecutar($sql);
		return $ejecutar;
	 }
	 function AccesoDoctor($user,$pass){
		$ocado=new cado();
		$sql="select dni, pass from medico where md5(dni)='$user' and pass='$pass'";
		$ejecutar=$ocado->ejecutar($sql);
		return $ejecutar;
	 }
	 function CambiarClave($ruc,$pass){
		$ocado=new cado();
		$sql="update convenio set pass='$pass'
		     where ruc='$ruc'";
		$ejecutar=$ocado->ejecutar($sql);
		return $ejecutar;
	 }
	 function CambiarClavePac($dni,$pass){
		$ocado=new cado();
		$sql="update paciente set pass='$pass'
		     where dni='$dni'";
		$ejecutar=$ocado->ejecutar($sql);
		return $ejecutar;
	 }
	 function ValidarClave($ruc,$pass){
		$ocado=new cado();
		$sql="select count(*) from convenio
		      where ruc='$ruc' and pass='$pass'";
		$ejecutar=$ocado->ejecutar($sql);
		return $ejecutar;
	 }
	 function ValidarClavePac($dni,$pass){
		$ocado=new cado();
		$sql="select count(*) from paciente
		      where dni='$dni' and pass='$pass'";
		$ejecutar=$ocado->ejecutar($sql);
		return $ejecutar;
	 }
	 /*function LisP($idsucu){
		  $ocado=new cado();
		  $sql="select id from paciente where id_sucursal=$idsucu";
		  $ejecutar=$ocado->ejecutar($sql);
		  return $ejecutar;
	 }
	 function Ins($idpac){
		  $ocado=new cado();
		  $sql="insert into he_ficha_atencion (id_paciente,crea_user,fec_crea) values($idpac,'MELIAS',now());
		        insert into he_serologia (id_ficha_atencion) values (LAST_INSERT_ID())";
		  $ejecutar=$ocado->ejecutar($sql);
		  return $ejecutar;
	 }*/
   }
?>