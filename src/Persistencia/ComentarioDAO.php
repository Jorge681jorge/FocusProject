<?php

class ComentarioDAO{
    private $idComentario;
    private $idUsuario;
    private $idVersion;
    private $comentario;
    private $fecha;
    private $hora;

    public function ComentarioDAO($idComentario = "", $idUsuario = "", $idVersion = "", $comentario = "", $fecha = "", $hora = ""){

        $this -> idComentario = $idComentario;
        $this -> idUsuario = $idUsuario;
        $this -> idVersion = $idVersion;
        $this -> comentario = $comentario;
        $this -> fecha = $fecha;
        $this -> hora = $hora;
    }

    public function insertar()
    {
        return "insert into comentario(idComentario, idUsuario, idVersion, comentario, fecha, hora)
                values ('" . $this -> idComentario . "','" . $this -> idUsuario . "','" . $this -> idVersion . "','" . $this -> comentario . "','" . $this -> fecha . "','" . $this -> hora . "')";
    }
    
    public function consultarTodos()
    {
        return "select idComentario, idUsuario, idVersion, comentario, fecha, hora
                from comentario";
    }
    public function consultarTodosVersion()
    {
        return "select idComentario, idUsuario, idVersion, comentario, fecha, hora
                from comentario
                where idVersion = '" .$this-> idVersion . "'";
    }

    public function consultarPaginacion($cantidad, $pagina)
    {
        return "select idComentario, idUsuario, idVersion, comentario, fecha, hora
                from comentario
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

}
?>