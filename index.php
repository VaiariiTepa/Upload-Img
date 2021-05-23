<?php 
    require 'class/classImage.php';
    
    // instance object img
    $classImg = new Image();

    // IF I WANT GET IMG LOCALY
    // get dir img
    // $dos_img = "img/";
    // $dir_img = opendir($dos_img);
    // $num_img = 0;

    // form validate
    if (!empty($_FILES)) {

        // get input files
        $img = $_FILES['img'];
        $p_description = $_POST['p_description'];
        
        // get input proprietary
        $classImg->img_description = $p_description;
        $classImg->img_name = $img['name'];
        
        // get extension files
        $ext = strtolower(substr($img['name'],-3));
        $allow_ext = array('jpg', 'png','gif');
        
        // move upload file || if img extension files
        if (in_array($ext,$allow_ext)){
            move_uploaded_file($img['tmp_name'],"img/".$img['name']);
        }else{
            $erreur = "Votre fichier n'est pas pris en charge";
        }

        // execute create img function
        $classImg->createImg();
    }
    
    $list_img = $classImg->getImg();

?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
    <title>Import d'image :)</title>
</head>
<body>
    <?php 
        if (isset($erreur)){
            print $erreur;
        }
    ?>
    <div class="container">
    
        <!-- 1st row -->
        <div class="row">
            <div class="col-7 mx-auto mt-5">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h4>
                                Importer une Image
                            </h4>
                        </center>
                        <br>
                        <form enctype="multipart/form-data" action="index.php" method="post">
                            .<div class="form-group">
                              <input type="text" class="form-control" name="p_description" aria-describedby="helpId" placeholder="Description">
                            </div>
                            <br>
                            <div class="input-group">
                                <input name="img" type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Importer">
                                <button class="btn btn-outline-info" type="submit" id="inputGroupFileAddon04">Envoyer</button>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="container-fluid">
        <!-- 2snd row -->
        <div class="row d-flex justify-content-around">
                <?php 
                    foreach ($list_img as $value) {
                        print '<div class="col-4">';
                            print '<div class="card" style="width: 18rem;">';
                                print '<img src="img/'.$value['name'].'" class="card-img-top" alt="...">';
                                print '<div class="card-body">';
                                    print '<h5 class="card-title">';
                                    print $value['description'];
                                    print '</h5>';
                                print '</div>';
                            print '</div>';   
                        print '</div>';
                    }
                ?>
        </div>
    

    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"></script>
</body>
</html>