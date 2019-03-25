<?php
require_once _model_ . 'Section.php';

class Sections
{
    public function getSections()
    {
        $sql = "SELECT * FROM sections ORDER BY id_section";
        $sections = Db::getInstance()->query($sql);
        if ($sections->count() > 0) {
            $rows = $sections->results();
            foreach ($rows as $row) {
                $data[] = array(
                    'id' => $row['id_section'],
                    'nombre' => $row['name_section'],
                    'url' => $row['url_section'],
                );
            }
        }
        return $data;
    }

    public function getSectionsByModule($id_module)
    {
        $sql = "SELECT * FROM sections WHERE id_module='" . $id_module . "'";
        $sections = Db::getInstance()->query($sql);
        if ($sections->count() > 0) {
            $rows = $sections->results();
            foreach ($rows as $row) {
                $data[] = array(
                    'id' => $row['id_section'],
                    'name' => $row['name_section'],
                    'url' => $row['url_section'],
                );
            }
        }
        return $data;
    }

    public function newSecciones()
    {

        $sss = new Consulta("SELECT * FROM estados");
        $c = "<select name='id_estado'>";
        $c .= "<option value=''> Seleccione Estado</option>";
        while ($rss = $sss->VerRegistro()) {
            $c .= "<option value='" . $rss[0] . "'> " . $rss[1] . " </option>";
        }
        $c .= "</select>";

        $matrix = array(1 => $c);

        $sql = "SELECT id_section, id_estado,
					name_section as name_section,
					correo_seccion as correo_seccion,
					telefono_seccion as telefono_seccion,
					empresa_seccion as empresa_seccion,
					fecha_seccion as fecha,
					descripcion_seccion as descripcion,
					observaciones_seccion as observacion
				FROM secciones WHERE id_section='" . $id . "'";
        $query = new Consulta($sql);
        Form::getForm($query, 'new', "secciones.php", $matrix);
    }

    public function editSecciones($id)
    {
        $querysecciones = new Consulta("SELECT * FROM secciones WHERE id_section='" . $id . "' ");
        $r = $querysecciones->VerRegistro();
        $sss = new Consulta("SELECT * FROM estados");
        $c = "<select name='id_estado'>";
        $c .= "<option value=''> Seleccione Estado</option>";
        while ($rss = $sss->VerRegistro()) {
            $c .= "<option value='" . $rss[0] . "' ";
            if ($rss[0] == $r['id_estado']) {
                $c .= " selected ";
            }
            $c .= "> " . $rss[1] . " </option>";
        }
        $c .= "</select>";

        $matrix = array(1 => $c);

        $sql = "SELECT id_section, id_estado,
					name_section as name_section,
					correo_seccion as correo_seccion,
					telefono_seccion as telefono_seccion,
					empresa_seccion as empresa_seccion,
					fecha_seccion as fecha,
					descripcion_seccion as descripcion,
					observaciones_seccion as observacion
				FROM secciones WHERE id_section='" . $id . "'";
        $query = new Consulta($sql);
        Form::getForm($query, 'edit', "secciones.php", $matrix);
    }

    public function addSection($id_user)
    {

        $sql = "INSERT INTO sections VALUES('','" . $id_user . "','" . $_POST['id_estado'] . "','" . $_POST['name_section'] . "','" . $_POST['correo_seccion'] . "','" . $_POST['telefono_seccion'] . "','" . $_POST['empresa_seccion'] . "','" . $_POST['descripcion'] . "','" . date('Y-m-d') . "','" . $_POST['observacion'] . "')";
        $Query = new Consulta($sql);
        $ID = mysql_insert_id();
    }

    public function updateSecciones($id)
    {

        $sql = " UPDATE secciones SET
						id_estado    		   = '" . $_POST['id_estado'] . "' ,
						correo_seccion    = '" . $_POST['correo_seccion'] . "',
						telefono_seccion  = '" . $_POST['telefono_seccion'] . "',
						empresa_seccion   = '" . $_POST['empresa_seccion'] . "',
						descripcion_seccion   	   = '" . $_POST['descripcion'] . "',
						observaciones_seccion     = '" . $_POST['observacion'] . "'
				WHERE id_section='" . $id . "' ";
        $update = new Consulta($sql);

        echo "<div id='error'> La actualizacion se realizo Correctamente </div>";
    }

    public function listSecciones()
    {
        $sql = "SELECT id_section, c.name_section, c.empresa_seccion, c.correo_seccion, date_format(c.fecha_seccion,'%d-%m-%Y') as fecha, e.nombre_estado as estado
				FROM secciones c, estados e
				WHERE c.id_estado = e.id_estado
				ORDER BY id_section DESC ";
        $query = new Consulta($sql);
        echo Listado::VerListado($query, "secciones.php");
    }

    public function deleteSecciones($id)
    {
        $sql = "DELETE FROM secciones WHERE id_section='" . $id . "' ";
        $query = new Consulta($sql);
    }
}
