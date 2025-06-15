<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname='proget_pff';
    $conn=mysqli_connect($servername,$username,$password,$dbname);
    if(isset($conn)){
      echo "<script>console.error('Base de données non connectée');</script>";
    }
    else{
        echo'base de donneés non connectée';
    }
    ?>