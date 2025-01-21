<?php 
    if(isset($_SESSION['id_user'])){
        unset($_SESSION['id_user']);
    }

    header('Location: ./?page=login')
?>