<?php


class CreateDb
{

    
    // get product from the database
    public function getData($tablename){
        $sql = "SELECT * FROM $tablename";
        $link = mysqli_connect('localhost', 'root', '', 'plmkoij');
        $result = mysqli_query($link, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
}






