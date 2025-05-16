<!-- <?php
        $conn=new PDO('mysql:host=localhost; dbname=test_db', 'root', '' ) or die(mysql_error());
        if(isset($_POST['submit'])!=""){
          $name=$_FILES['file']['name'];
          $size=$_FILES['file']['size'];
          $type=$_FILES['file']['type'];
          $temp=$_FILES['file']['tmp_name'];
          $fname = date("YmdHis").'_'.$name;
          $chk = $conn->query("SELECT * FROM  upload where name = '$name' ")->rowCount();
          if($chk){
            $i = 1;
            $c = 0;
                while($c == 0){
                $i++;
                $reversedParts = explode('.', strrev($name), 2);
                $tname = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));
                $chk2 = $conn->query("SELECT * FROM  upload where name = '$tname' ")->rowCount();
                if($chk2 == 0){
                        $c = 1;
                        $name = $tname;
                }
            }
        }
         $move =  move_uploaded_file($temp,"upload/".$fname);
         if($move){
                $query=$conn->query("insert into upload(name,fname)values('$name','$fname')");
                if($query){
                header("location:upload_notes.php");
                }
                else{
                die(mysql_error());
                }
         }
        }
        ?>
<html>
<head>
<title>Upload and Download Files</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style_upload.css">

	
    </head>

<body>  
    <div class="containner  ">
    <h1>Avaliable E-Notes</h1><br>
        <br>
        <form enctype="multipart/form-data" action="" name="form" method="post">
            Select File
            <input type="file" name="file" id="file" class="file" /></td>
            <input type="submit" name="submit" id="submit" value="Submit" />
        </form>
        <br>
        <br>
        <table cellpadding="0" cellspacing="0" border="0" class="table-striped table-bordered  table-responsive-xxl  " id="example">
                        <thead>
                                <tr>
                                        <th width="90%" align="center">Files</th>
                                        <th align="center" width="200px">Action</th> 
                                </tr>
                        </thead>
                        <?php
                        $query=$conn->query("select * from upload order by id desc");
                        while($row=$query->fetch()){
                                $name=$row['name'];
                        ?>
                        <tr class="table-danger">
                                <td >
                                        &nbsp;<?php echo $name ;?>
                                </td>
                                
                                <td>
                                    
                                        <button class="alert-success"><a href="download.php?filename=<?php echo $name;?>&f=<?php echo $row['fname'] ?>">Download</a></button>
                                        
                               
                                        <button class="alert-success"><a target="_blank" href="<?php echo "upload/".$row['fname'] ?>">view</a></button>
                                </td>
                        </tr>
                        <?php }?>
                </table>
    </div>
</body>

</html> -->