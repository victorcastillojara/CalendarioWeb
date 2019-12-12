<?php
include_once 'conexion.php';
include_once 'database.php';

if(isset($_POST['btnBuscar'])){

    if($_POST['rut']!=null){

        $rut=$_POST['rut'];
    
        if(valida_rut($rut)==true){
            $db=new Database();
    
            $query=$db->connect()->prepare('SELECT * FROM docente WHERE rut=:rut');
            $query->execute(['rut'=>$rut]);
            $row=$query->fetch(PDO::FETCH_NUM);
    
            $_POST['nombre']=$row[2];
            require('registro-docente.php');
        }else{
                echo "<script>alert('Rut ingresado no es válido, favor revisar si está correctamente escrito');</script>";
                require('registro-docente.php');
            }
    }else{
        echo "<script>alert('Error: no debe dejar campos vacíos');</script>";
        require('registro-docente.php');
    }

}




function valida_rut($rut){
    $rut = preg_replace('/[^k0-9]/i', '', $rut);
    $dv  = substr($rut, -1);
    $numero = substr($rut, 0, strlen($rut)-1);
    $i = 2;
    $suma = 0;
    foreach(array_reverse(str_split($numero)) as $v)
    {
        if($i==8)
            $i = 2;
        $suma += $v * $i;
        ++$i;
    }
    $dvr = 11 - ($suma % 11);
    
    if($dvr == 11)
        $dvr = 0;
    if($dvr == 10)
        $dvr = 'K';
    if($dvr == strtoupper($dv))
        return true;
    else
        return false;
}
?>