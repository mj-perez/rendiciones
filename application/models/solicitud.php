<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class solicitud extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

    function agregar_solicitudfondo($data){
    	$sp="execute Agregar_SolicitudFondo ".$data["usuario"].",".$data["empresa"].",".$data["cliente"].",".$data["monto"].",'".$data["motivo"]."','".$data["rut_sup"]."',".$data["fondo"].",'".$data["ncuenta"]."',".$data["banco"].",".$data["fpago"].",'".$data["archivo"]."'";
    	$res=$this->db->query($sp);
    	return $res->num_rows();
    }

    function supervisor($rut){
    	$query="select ncuenta, id_banco
    	from supervisores where rut='".$rut."'";
    	$res=$this->db->query($query);
    	return $res->row_array();
    }


    function solicitudes(){
    	$query="select s.id_fondo, e.egrupo,c.cliente, u.Nombre+' '+u.Ap_Paterno as solicitante,
            isnull(su.nombres+' '+su.ap_paterno,u.Nombre+' '+u.Ap_Paterno) as responsable,
            isnull(su.rut,u.rut) as rut, 
            convert(varchar,s.fecha_registro,105) as fecha_registro, s.motivo,s.estado
        from solicitudfondo s
        inner join sgi_egrupo e on(s.ID_Egrupo=e.ID_EGrupo)
        inner join sgi_clientes c on(s.ID_Cliente=c.ID_Cliente)
        inner join usuarios u on(s.ID_Usuario=u.ID_Usuario)
        left join Supervisores su on(s.rut_encargado=su.rut)
        inner join estados es on(s.estado=es.id_estado)
        where 1=1";
    	$res=$this->db->query($query);
    	return $res->result_array();
    }

    function buscarsolicitudes($solicitante,$empresa,$cliente,$fecha,$estado){
        $query="select s.id_fondo, e.egrupo,c.cliente, u.Nombre+' '+u.Ap_Paterno as solicitante,
            isnull(su.nombres+' '+su.ap_paterno,u.Nombre+' '+u.Ap_Paterno) as responsable,
            isnull(su.rut,u.rut) as rut, 
            convert(varchar,s.fecha_registro,105) as fecha_registro, s.motivo,s.estado
        from solicitudfondo s
        inner join sgi_egrupo e on(s.ID_Egrupo=e.ID_EGrupo)
        inner join sgi_clientes c on(s.ID_Cliente=c.ID_Cliente)
        inner join usuarios u on(s.ID_Usuario=u.ID_Usuario)
        left join Supervisores su on(s.rut_encargado=su.rut)
        where 1=1";
        if($solicitante!=""){
            $query.="and s.id_usuario=".$solicitante;
        }
        if($empresa!=""){
            $query.="and s.id_egrupo=".$empresa;
        }
        if($cliente!=""){
            $query.="and s.id_cliente=".$cliente;
        }
        if($estado!=""){
            $query.="and s.estado=".$estado;
        }
        if($fecha!=""){
            $query.="and s.fecha_registro='".$fecha."'";
        }
        $res=$this->db->query($query);
        return $res->result_array();
    }


    function detallesolicitud($id){
        $query="select 
                s.id_fondo, e.egrupo,c.cliente, u.Nombre+' '+u.Ap_Paterno as solicitante,
            isnull(su.nombres+' '+su.ap_paterno,u.Nombre+' '+u.Ap_Paterno) as responsable,
            isnull(su.rut,u.rut) as rut, 
            convert(varchar,s.fecha_registro,105) as fecha_registro, s.motivo,isnull(fp.fpago,'-') as fpago, 
            SUBSTRING((replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(s.monto as money), 1)),',',';')),'.',',')),';','.')),1,len(replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(s.monto as money), 1)),',',';')),'.',',')),';','.'))-3) as monto, 
            isnull(convert(varchar,s.fecha_rendicion,105),'-') as fecha_rendicion,
            tf.tipo_fondo, isnull(s.ncuenta,'-') as ncuenta,isnull(b.banco,'-') as banco, s.archivo_solicitud, s.comentario, es.estado, s.id_egrupo,s.id_banco,s.id_cliente
            from solicitudfondo s
            left join SGI_FPagos fp on(s.ID_FormaPago=fp.ID_FPago)
            inner join Tipo_Fondos tf on(s.id_tipo_fondo=tf.id_tipo_fondo)
            left join  SGI_Bancos b on(s.id_banco=b.ID_Banco)
            inner join estados es on(s.estado=es.id_estado)
            inner join sgi_egrupo e on(s.ID_Egrupo=e.ID_EGrupo)
            inner join sgi_clientes c on(s.ID_Cliente=c.ID_Cliente)
            inner join usuarios u on(s.ID_Usuario=u.ID_Usuario)
            left join Supervisores su on(s.rut_encargado=su.rut)
            where s.ID_Fondo=".$id;
        $res=$this->db->query($query);
        return $res->row_array();
    }

    function aprobacionjefe($id,$estado){
        $sp="execute AprobacionJefe_SolicitudFondo ".$id.",".$estado;
        $res=$this->db->query($sp);
        return $res->num_rows();
    }

    function aprobacionfinanzas($id,$estado){
        $sp="execute AprobacionFinanzas_SolicitudFondo ".$id.",".$estado;
        $res=$this->db->query($sp);
        return $res->num_rows();
    }

    function solicitudesxrendir(){
        $query="select s.id_fondo, e.egrupo,c.cliente, u.Nombre+' '+u.Ap_Paterno as solicitante,
            isnull(su.nombres+' '+su.ap_paterno,u.Nombre+' '+u.Ap_Paterno) as responsable,
            isnull(su.rut,u.rut) as rut, 
            convert(varchar,s.fecha_registro,105) as fecha_registro, s.motivo,s.estado
        from solicitudfondo s
        inner join sgi_egrupo e on(s.ID_Egrupo=e.ID_EGrupo)
        inner join sgi_clientes c on(s.ID_Cliente=c.ID_Cliente)
        inner join usuarios u on(s.ID_Usuario=u.ID_Usuario)
        left join Supervisores su on(s.rut_encargado=su.rut)
        inner join estados es on(s.estado=es.id_estado)
        where s.estado=1";
        $res=$this->db->query($query);
        return $res->result_array();
    }
}

?>