<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rendicion extends CI_model {
	function __construct()
    {
        parent::__construct();
    }

    function agregar_rendicion($data){
        $sp="execute Agregar_Rendicion ".$data["monto_entregado"].", ".$data["total_rendido"].", ".$data["saldo_empresa"].", '".$data["ncuenta"]."', ".$data["tipo_rendicion"].", ".$data["cliente"].", ".$data["empresa"].", ".$data["usuario"].", ".$data["banco"];
        $res = $this->db->query($sp);
        return $res->num_rows();
    }


    function agregar_rendiciondetalle($data){
        $sp="execute Agregar_RendicionDetalle ".$data["total"].", ".$data["tipo"];
        $res = $this->db->query($sp);
        return $res->num_rows();
    }

    function agregar_rendiciondetallegastos($data){
        $sp="execute Agregar_RendicionDetalleGastos '".$data["fecha"]."', ".$data["monto"].", '".$data["detalle_gasto"]."', '".$data["ndocumento"]."', ".$data["tipo_gasto"].", null";
        $res = $this->db->query($sp);
        return $res->num_rows();
    }


    function idrendicion(){
        $query="select max(id_rendicion) as idrendicion from rendicion ";
        $res = $this->db->query($query);
        return $res->row_array();
    }

   function rendicion($id_rendicion){
        $query="select r.id_rendicion,
            SUBSTRING((replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(r.Monto_entregado as money), 1)),',',';')),'.',',')),';','.')),1,len(replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(r.Monto_entregado as money), 1)),',',';')),'.',',')),';','.'))-3) as monto_entregado,
            convert(varchar,r.Fecha_registro,105) as fecha_registro,
            SUBSTRING((replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(r.Total_rendido as money), 1)),',',';')),'.',',')),';','.')),1,len(replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(r.Total_rendido as money), 1)),',',';')),'.',',')),';','.'))-3) as total_rendido,
            SUBSTRING((replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(r.Saldo_empresa as money), 1)),',',';')),'.',',')),';','.')),1,len(replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(r.Saldo_empresa as money), 1)),',',';')),'.',',')),';','.'))-3) as saldo_empresa,
            r.ncuenta, 
            tr.Tipo_Rendicion,
            c.Cliente,
            e.EGrupo,
            b.Banco,
            u.Nombre+' '+u.Ap_Paterno as solicitante, 
            u.rut,
            u.email
            from Rendicion r
            inner join Tipo_Rendicion tr on(r.ID_Tipo_Rendicion=tr.ID_Tipo_Rendicion)
            inner join SGI_Clientes c on(r.ID_Cliente=c.ID_Cliente)
            inner join SGI_EGrupo e on(r.ID_Egrupo=e.ID_EGrupo)
            inner join Usuarios u on(r.ID_Usuario=u.ID_Usuario)
            inner join SGI_Bancos b on(r.ID_Banco=b.ID_Banco)
            where r.id_rendicion=".$id_rendicion;
        $res=$this->db->query($query);
        return $res->row_array();
    }

    function rendiciondetalle($id_rendicion){
        $query="select tg.Tipo_Gasto,
            SUBSTRING((replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(rd.total as money), 1)),',',';')),'.',',')),';','.')),1,len(replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(rd.total as money), 1)),',',';')),'.',',')),';','.'))-3) as total
            from rendicion r
            inner join RendicionDetalle rd on(r.id_rendicion=rd.id_rendicion)
            inner join Tipo_Gastos tg on(rd.ID_Tipo_Gasto=tg.ID_Tipo_Gasto)
            where r.ID_Rendicion=".$id_rendicion;
        $res=$this->db->query($query);
        return $res->result_array();
    }


    function rendiciondetallegastos($id_rendicion){
        $query="select tg.Tipo_Gasto, convert(varchar,rdg.fecha,105) as fecha,
            SUBSTRING((replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(rdg.monto as money), 1)),',',';')),'.',',')),';','.')),1,len(replace(convert(varchar,replace(convert(varchar,replace((CONVERT(VarChar(50), cast(rdg.monto as money), 1)),',',';')),'.',',')),';','.'))-3) as monto,
            rdg.Detalle_Gasto,
            rdg.NDocumento
            from Rendicion r 
            inner join RendicionDetalle rd on(r.ID_Rendicion=rd.ID_Rendicion)
            inner join RendicionDetalleGastos rdg on(rd.ID_RendicionDetalle=rdg.ID_RendicionDetalle)
            inner join Tipo_Gastos tg on(rd.ID_Tipo_Gasto=tg.ID_Tipo_Gasto)
            where r.ID_Rendicion=".$id_rendicion;
        $res=$this->db->query($query);
        return $res->result_array();
    }


    function solicitudesxrendir(){
        $query="select r.id_rendicion,
                e.egrupo,
                tr.tipo_rendicion,
                c.cliente,
                u.Nombre+' '+u.Ap_Paterno as solicitante,
                convert(varchar,r.fecha_registro,105) as fecha_registro
            from rendicion r 
            inner join SGI_Clientes c on(r.ID_Cliente=c.ID_Cliente)
            inner join Usuarios u on(r.ID_Usuario=u.ID_Usuario)
            inner join SGI_EGrupo e on(r.ID_Egrupo=e.ID_EGrupo)
            inner join Tipo_Rendicion tr on(r.ID_Tipo_Rendicion=tr.ID_Tipo_Rendicion)
            --where r.Aprobado=0 ";
        $res = $this->db->query($query);
        return $res->result_array();

    }
    

 
	
}

	
?>