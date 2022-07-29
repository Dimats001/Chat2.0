<?php
    //Каждый раз при попадании сюда переписка обновляется
    if(!isset($_REQUEST['message'])){ //Передан пустой запрос = надо просто обновить чат
        $conn = new mysqli('localhost', 'root', '', 'myProjects');
        if($conn -> connect_error)
            die($conn -> connect_error);
        else{
            $query = "SELECT * FROM messages";
            $result = $conn -> query($query);
            for($i = 0; $i < $result -> num_rows; $i ++){
                $result -> data_seek($i);
                $row = $result -> fetch_array(MYSQLI_ASSOC);
                $msg = $row['message'];
                $time = $row['time'];
                $author = $row['author'];
                echo <<<_END
                    <b>$time   $author:</b> $msg <br>
                _END;
            }
        }
    }else{
        $msg = $_REQUEST['message']; //Тут неплохо бы проверять на безопасность
        $conn = new mysqli('localhost', 'root', '', 'myProjects');
        if($conn -> connect_error)
            die($conn -> connect_error);
        else{
            $query = "INSERT INTO messages VALUES('*Автор', '$msg', '17:12')";
            $conn -> query($query);
        }
    }
?>