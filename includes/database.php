<?php
    try {
        $pdo  = new PDO('mysql:host=localhost;dbname=todo','root','root');
    }
    catch(PDOException $e){
        die("Error Connection : ".$e->getMessage());
    }
?>