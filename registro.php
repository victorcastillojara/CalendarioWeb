<?php
include_once 'conexion.php';
include_once 'database.php';



if($_POST['rut']!=null){

    $rut=$_POST['rut'];

    if(valida_rut($rut)==true){
        $db=new Database();

        $query=$db->connect()->prepare('SELECT * FROM docente WHERE rut=:rut');
        $query->execute(['rut'=>$rut]);
        $row=$query->fetch(PDO::FETCH_NUM);

        if($row!=true){


            if($_POST['nombre']!=null && $_POST['apellido']!=null && $_POST['telefono']!=null && $_POST['direccion']!=null && $_POST['correo']!=null && $_POST['password']!=null){
            
                $nombre=$_POST['nombre'];
                $apellido=$_POST['apellido'];
                $telefono=$_POST['telefono'];
                $direccion=$_POST['direccion'];
                $correo=$_POST['correo'];
                $password=$_POST['password'];

            
                

                $query1=$db->connect()->prepare("INSERT INTO docente (rut,nombre,apellido,telefono,direccion,correo)
                VALUES('$rut','$nombre','$apellido','$telefono','$direccion','$correo')");
                $query1->execute();

                

                

                $id_usuario=$row[0];

                $query2=$db->connect()->prepare("INSERT INTO usuario (id_usuario,correo,password,id_rol)
                VALUES('$id_usuario','$correo','$password',2)");
                $query2->execute();

                $query3=$db->connect()->prepare("UPDATE docente SET id_usuario=:id_usuario WHERE rut=:rut");
                $query3->execute(['id_usuario'=>$id_usuario, 'rut'=>$rut]);

                if($query==true && $query1==true && $query2==true && $query3==true){
                    echo "<script>alert('Registro exitoso');</script>";
                    require('registro-docente.php');
                }else{
                    echo "<script>alert('Error en el registro');</script>";
                    require('registro-docente.php');
                }

            }else{
                echo "<script>alert('Error: no debe dejar campos vacíos');</script>";
                require('registro-docente.php');
            }
        }else{
            echo "<script>alert('Usted esta aqui');</script>";
                require('registro-docente.php');
        }
    }else{
            echo "<script>alert('Rut ingresado no es válido, favor revisar si está correctamente escrito');</script>";
            require('registro-docente.php');
        }
}else{
    echo "<script>alert('Error: no debe dejar campos vacíos');</script>";
    require('registro-docente.php');
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