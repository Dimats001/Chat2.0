<?php
    session_start();
    if(isset($_REQUEST['user'])){
        $conn = new mysqli('localhost', 'root', '', 'myProjects');
        if($conn -> connect_error)
            die($conn -> connect_error);
        else{
            $user = $_REQUEST['user'];
            $pass = $_REQUEST['pass'];

            $query = "SELECT * FROM users WHERE username = '$user'";
            $result = $conn -> query($query);
            if($result -> num_rows == 0)
                echo false;
            else{
                $result -> data_seek(0);
                $row = $result -> fetch_array(MYSQLI_ASSOC);
                $pass_real = $row['password'];
                if($pass === $pass_real){  //Например, +100 == 100, но не ===
                    echo true;
                    $_SESSION['user'] = $user;
                }
            }
        }
    }else{

            echo "Приветствуем, " . $_SESSION['user']. " <a href = 'reg.html'>Хотите выйти?</a>";
    }
?>