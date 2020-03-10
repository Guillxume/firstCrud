<?php

session_start();
//____________________________________________________CONNEXION___________________________________________________________________________
$mysqli = new mysqli('localhost', 'root', 'root', 'crud') or die(mysqli_error($mysqli));
$update = false;
$disc_name = '';
$disc_year = '';
$disc_label = '';
$disc_genre = '';
$disc_prix = '';
$id = 0;
//______________________________________________________LECTURE___________________________________________________________________________

$result = $mysqli->query("SELECT * FROM data ORDER BY disc_name");
//_______________________________________________________SAVE___________________________________________________
if (isset($_POST['save'])) {
    $disc_name = $_POST['disc_name'];
    $disc_year = $_POST['disc_year'];
    $disc_label = $_POST['disc_label'];
    $disc_genre = $_POST['disc_genre'];
    $disc_prix = $_POST['disc_prix'];
    $disc_image = $_FILES['disc_image']['name'];
    $disc_image_tmp = $_FILES['disc_image']['tmp_name'];
    // Folder permet d'obtenir le chemin du fichier et le nom on la concactene avec $disc_name
    $folder = 'assets/img/local/' . $disc_name;
    // on extrait l'extension avec strrchr qui recherche tout ce qu'il y a après le point, substr extrait le résultat de la string
    $ext = $disc_image_type = strtolower(pathinfo($disc_image, PATHINFO_EXTENSION));
    //move_uploaded_file déplace le fichier temporaire vers le repertoire local 
    move_uploaded_file($disc_image_tmp, $folder . '.' . $ext);
    //disc_image permet de mettre l'adresse et le nom du fichier et l'extension 
    $disc_image = $folder . '.' . $ext;
    //___________________________________________________________FORM CHECK ________________________________________________________________
    //Si un champ est laissé vidé, rien ne s'envoie
    if(empty($disc_name)|empty($disc_year)|empty($disc_label)|empty($disc_prix)){
        $_SESSION['message'] = "ERROR : empty field";
        $_SESSION['msg_type'] = "danger"; 
        header("location: view.php");
    }
    else{
        // Si les RegEx sont respectées, vérification de l'image
        if(preg_match('/[a-zA-Z0-9]/', $disc_name)&&preg_match('/[0-9]/', $disc_year)&&preg_match('/[a-zA-Z0-9]/', $disc_label)&&preg_match('/[a-zA-Z0-9]/', $disc_genre)&&preg_match('/[0-9]/', $disc_prix) )
        { 
            // Si ce n'est pas une image où si il n'y en a pas, erreur 
            if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" | $ext = "") {
    $_SESSION['message'] = "ERROR : File is not an image or empty";
    $_SESSION['msg_type'] = "danger"; 
    header("location: view.php");
} else {
    //Ajout dans la table data de la base de données 
    $mysqli->query("INSERT INTO data (disc_name, disc_year, disc_label, disc_genre, disc_prix, disc_image)
    VALUES ('$disc_name','$disc_year','$disc_label','$disc_genre','$disc_prix', '$disc_image')") or
        die($mysqli->error);
    // $_SESSION permet d'écrire du contenu dans la balise d'alerte dans view.php
    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";
    // header renvoie vers view.php
    header("location: view.php");
    }
}
        else { 
    $_SESSION['message'] = "ERROR : incorrect value.s , please check your fields or stop hacking you mf";
    $_SESSION['msg_type'] = "danger";
    header("location: view.php");
}
}
}
//_______________________________________________________________________DELETE__________________________________________________________
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($msqli->error());

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: view.php");
}
//___________________________________________________________________________UPDATE__________________________________________________________
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($msqli->error());
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $disc_name = $row['disc_name'];
        $disc_year = $row['disc_year'];
        $disc_label = $row['disc_label'];
        $disc_genre = $row['disc_genre'];
        $disc_prix = $row['disc_prix'];
        $disc_image = $_FILES['disc_image']['name'];
    $disc_image_tmp = $_FILES['disc_image']['tmp_name'];
    // Folder permet d'obtenir le chemin du fichier et le nom on la concactene avec $disc_name
    $folder = 'assets/img/local/' . $disc_name;
    // on extrait l'extension avec strrchr qui recherche tout ce qu'il y a après le point, substr extrait le résultat de la string
    $ext = substr(strrchr($_FILES["disc_image"]["name"], "."), 1);
    //move_uploaded_file déplace le fichier temporaire vers le repertoire local 
    move_uploaded_file($disc_image_tmp, $folder . '.' . $ext);
    //disc_image permet de mettre l'adresse et le nom du fichier et l'extension 
    $disc_image = $folder . '.' . $ext;
    }
}
// SI le bouton update est cliqué, on update les données de l'ID sélectionné 
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $disc_name = $_POST['disc_name'];
    $disc_name = $_POST['disc_name'];
    $disc_year = $_POST['disc_year'];
    $disc_label = $_POST['disc_label'];
    $disc_genre = $_POST['disc_genre'];
    $disc_prix = $_POST['disc_prix'];
    $disc_image = $_FILES['disc_image']['name'];
    $disc_image_tmp = $_FILES['disc_image']['tmp_name'];
    // Folder permet d'obtenir le chemin du fichier et le nom on la concactene avec $disc_name
    $folder = 'assets/img/local/' . $disc_name;
    // on extrait l'extension avec strrchr qui recherche tout ce qu'il y a après le point, substr extrait le résultat de la string
    $ext = substr(strrchr($_FILES["disc_image"]["name"], "."), 1);
    //move_uploaded_file déplace le fichier temporaire vers le repertoire local 
    move_uploaded_file($disc_image_tmp, $folder . '.' . $ext);
    //disc_image permet de mettre l'adresse et le nom du fichier et l'extension 
    $disc_image = $folder . '.' . $ext;
    if(empty($disc_name)|empty($disc_year)|empty($disc_label)|empty($disc_prix)){
        $_SESSION['message'] = "ERROR : empty field";
        $_SESSION['msg_type'] = "danger"; 
        header("location: view.php");
    }
    else{
        // Si les RegEx sont respectées, vérification de l'image
        if(preg_match('/[a-zA-Z0-9]/', $disc_name)&&preg_match('/[0-9]/', $disc_year)&&preg_match('/[a-zA-Z0-9]/', $disc_label)&&preg_match('/[a-zA-Z0-9]/', $disc_genre)&&preg_match('/[0-9]/', $disc_prix) )
        { 
            // Si ce n'est pas une image où si il n'y en a pas, erreur 
            if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" | $ext = "") {
    $_SESSION['message'] = "ERROR : File is not an image or empty";
    $_SESSION['msg_type'] = "danger"; 
    header("location: view.php"); 
}
 else {
    $mysqli->query("UPDATE data SET disc_name = '$disc_name', disc_year = '$disc_year', disc_label = '$disc_label', disc_genre = '$disc_genre', disc_prix = '$disc_prix', disc_image = '$disc_image' WHERE id = '$id'") or die($mysqli->error);
    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: view.php");
}
        }
else { 
    $_SESSION['message'] = "ERROR : incorrect value.s , please check your fields or stop hacking you mf";
    $_SESSION['msg_type'] = "danger";
    header("location: view.php");
}
}
} 

?>