<?php
    //open connection to mysql db
    $connection = mysqli_connect("localhost","spandana","Trees803@","spandanagroups") or die("Error " . mysqli_error($connection));

    //fetch table rows from mysql db
    $sql = "select * from members";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array
    $array = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $array[] = $row;
    }
    echo json_encode($array);

    //close the db connection
    mysqli_close($connection);
?>