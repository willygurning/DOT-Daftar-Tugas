<?php
    $conn = new mysqli("localhost","root","","vuecrud");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }
    echo("Success");

    $result = array('error=>false');
    $action = '';

    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    if($action == 'read'){
        $sql = $conn->query("SELECT * FROM tugasvue");
        $tugasvue = array();
        while($row = $sql->fetch_assoc()){
            array_push($tugasvue, $row);
        }
        $result['tugasvue'] = $tugasvue;
    }
    
    if($action == 'create'){
        $Tugas = $_POST['Tugas'];
        $Keterangan = $_POST['Keterangan'];
        $sql = $conn->query("INSERT INTO tugasvue (Tugas,Keterangan)
            VALUES('$Tugas','$Keterangan')");
        if($sql){
            $result['message']="Tugas Ditambahkan!";
        }
        else{
            $result['error']=true;
            $result['message']="gagal menambahkan tugas";
            
        }
    }



    if($action == 'update'){
        $id = $_POST['id'];
        $Tugas = $_POST['Tugas'];
        $Keterangan = $_POST['Keterangan'];
        $sql = $conn->query("UPDATE  tugasvue SET Tugas='$Tugas', Keterangan='$Keterangan' WHERE id='$id' ");
           
        if($sql){
            $result['message']="Tugas Dirubah!";
        }
        else{
            $result['error']=true;
            $result['message']="gagal merubah tugas";
            
        }
    }

    if($action == 'delete'){
        $id = $_POST['id'];
       
        $sql = $conn->query("DELETE FROM tugasvue WHERE id='$id' ");
        
        if($sql){
            $result['message']="Tugas dihapus!";
        }
        else{
            $result['error']=true;
            $result['message']="gagal menghapus tugas";
            
        }
    }
    $conn->close();
    echo json_encode($result);
?>