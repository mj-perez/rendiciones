<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class funcion_login extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

    function login($usuario, $password){
		$query="select u.nombre + ' '  + u.ap_paterno as persona, u.id_usuario as usuario, u.id_perfil as perfil,
            isnull(c.ncuenta,0) as  ncuenta,isnull(c.id_banco,0) as id_banco
            from Usuarios u left join sgi_contratos c on(u.rut= replace(c.rut,'.','')) 
            where u.activo=1 and usuario='".$usuario."' and password='".$password."'";
        $res = $this->db->query($query);
		if($res->num_rows()!=0){
            return $res->result_array();
        } else {
            $query="select s.nombres+' '+s.ap_paterno as persona, u.id_usuario as usuario, u.id_perfil as perfil,
                isnull(s.ncuenta,0) as  ncuenta, isnull(s.id_banco,0) as id_banco, id_cliente
                from usuariosg u inner join Supervisores s on(u.rut=s.rut)
                where u.activo=1 and usuario='".$usuario."' and password='".$password."'";
            $res = $this->db->query($query);
            if($res->num_rows()!=0){
                return $res->result_array();
            } else {
                return 0;
            }
        }
    }
	
}

	
?>