<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class listar extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

    function solicitante($usuario){
		$query="select u.nombre + ' '  + u.ap_paterno as nombre, 
        u.rut, 
        u.email
        from Usuarios u 
        where u.id_usuario=".$usuario." ";
        $res = $this->db->query($query);
        return $res->row_array();

    }

    function tipo_rendiciones(){
        $query="select id_tipo_rendicion, tipo_rendicion
        from tipo_rendicion where activo=1";
        $res = $this->db->query($query);
        return $res->result_array();
    }


    function empresas(){
        $query="select id_egrupo,egrupo
        from sgi_egrupo";
        $res = $this->db->query($query);
        return $res->result_array();
    }


    function clientes($usuario){
        $query="select c.id_cliente,c.cliente
        from sgi_clientes c
        inner join sgi_usuario_cliente uc on(c.id_cliente=uc.id_cliente)
        where c.activo=1 and uc.activo=1 and uc.id_usuario=".$usuario;
        $res = $this->db->query($query);
        if($res->num_rows()!=0){
            return $res->result_array();
        } else {
            $query="select c.id_cliente,c.cliente
                from usuariosg u
                inner join supervisores s on(u.rut=s.rut)
                inner join sgi_clientes c on(s.id_cliente=c.id_cliente)
                where c.activo=1 and u.activo=1 and u.id_usuario=".$usuario;
            $res = $this->db->query($query);
            return $res->result_array();
        }
    }


    function cliente(){
        $query="select c.id_cliente,c.cliente
        from sgi_clientes c order by c.cliente asc";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    function bancos(){
        $query="select id_banco, banco
        from sgi_bancos where id_banco <> 1";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    function gastos(){
        $query="select id_tipo_gasto, tipo_gasto
        from tipo_gastos where activo=1";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    function usuarios(){
        $query="select id_usuario, nombre + ' '  + ap_paterno as nombre
        from usuarios order by nombre asc";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    
    function estados(){
        $query="select id_estado, estado, color
        from estados where activo=1";
        $res = $this->db->query($query);
        return $res->result_array();
    }
	

    function supervisores($usuario){
        $query="select rut, nombres+' '+ap_paterno as nombre
            from supervisores
            where id_cliente in (select id_cliente from SGI_Usuario_Cliente where id_usuario=".$usuario.")";
        $res=$this->db->query($query);
        return $res->result_array();
    }

    function formapago(){
        $query="select id_fpago, fpago
        from sgi_fpagos  where id_fpago not in (1,4)";
        $res = $this->db->query($query);
        return $res->result_array();
    }


    function fondos(){
        $query="select id_tipo_fondo, tipo_fondo
        from tipo_fondos";
        $res = $this->db->query($query);
        return $res->result_array();
    }
}

	
?>