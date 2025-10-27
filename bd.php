<?php
    function insertar($query, $datos){
        $con = pg_connect("host=localhost port=5432 user=postgres password=3310904323 dbname=crud");
        //pg_insert($con, "clientes",[])
        
        $respuesta = pg_prepare($con, "insertar", $query);
        $respuesta2 = pg_execute($con, "insertar", $datos);

        pg_close($con);
    }
    
    function eliminar($query, $datos){
        $con = pg_connect("host=localhost port=5432 user=postgres password=3310904323 dbname=crud");

        var_dump($con);

        $respuesta = pg_prepare($con, "delete", $query);
        $respuesta2 = pg_execute($con, "delete", $datos);

        var_dump($respuesta);

        pg_close($con);
    }
    
    function modificar($query, $datos){
        $con = pg_connect("host=localhost port=5432 user=postgres password=3310904323 dbname=crud");
        $respuesta = pg_prepare($con, "update", $query);
        $respuesta2 = pg_execute($con, "update", $datos);
        
        var_dump($respuesta);

        pg_close($con);
    }
    
    function seleccionar($query, $datos){
        $con = pg_connect("host=localhost port=5432 user=postgres password=3310904323 dbname=crud");
        
        $respuesta = pg_prepare($con, "select", $query);
        $respuesta2 = pg_execute($con, "select", $datos);
        
        // Usa pg_fetch_all para obtener todos los resultados
        $resultados = pg_fetch_all($respuesta2);
        
        pg_close($con);
        return $resultados;
    }
    //seleccionar("select stock from productos",[]);
?>