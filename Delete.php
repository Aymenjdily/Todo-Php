<?php 
    if(isset($_POST['delete'])){
        require_once'includes/database.php';

        $id = $_POST['id'];

        $sqlState = $pdo->prepare('DELETE FROM tasks WHERE id=?');
        $result = $sqlState->execute([$id]);

        header('location:index.php');
    }
?>