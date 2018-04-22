<?php
session_start();
@$logged = isset($_SESSION['logged']) ? $_SESSION['logged'] : false;
@$action = $_REQUEST['action'];

if($logged && $action == 'Upload'){
          $dossier = 'img/artwork/';
          $fichier = basename($_FILES['avatar']['name']);
          $taille_maxi = 10000000;
          $taille = filesize($_FILES['avatar']['tmp_name']);
          $extensions = array('.png', '.gif', '.jpg', '.jpeg');
          $extension = strrchr($_FILES['avatar']['name'], '.'); 

          // début des vérifications de sécurité...

          // si l'extension n'est pas dans le tableau
          if(!in_array($extension, $extensions)) 
          {
               $erreur = 'File extension is not valid.';
          }

          // si le fichier est trop gros
          if($taille>$taille_maxi)
          {
               $erreur = 'File size is too large.';
          }

          // d'il n'y a pas d'erreur, on upload
          if(!isset($erreur)) 
          {
               //On formate le nom du fichier ici...
               $fichier = mb_strtolower($fichier, 'UTF-8');
               $fichier = str_replace(
               array('à','â','ä','á','ã','å','î','ï','ì','í','ô','ö','ò','ó','õ','ø','ù','û','ü','ú','é','è','ê','ë','ç','ÿ','ñ', ),
               array('a','a','a','a','a','a','i','i','i','i','o','o','o','o','o','o','u','u','u','u','e','e','e','e','c','y','n', ),
               $fichier);
           
               $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

               // si la fonction renvoie TRUE, c'est que ça a fonctionné...
               if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) 
               {
                  echo 'Successfully uploaded!';
                    $name="img/artwork/$fichier";
                    $filename="img/artwork/thumbs/$fichier";
                    // création du thumbnail
                    createthumb($name,$filename,103,150);

                    // insertion dans la base de donnée
                    // script de connexion à la DB
                    include('connexion.php');

                    $query = "INSERT INTO artwork (url) VALUES ('$fichier');"; 
                    $result = $mysqli->query($query) or die($mysqli->error);

                    echo "<script>window.history.go(-1);</script>";

               }
               // sinon la fonction renvoie FALSE
               else 
               {
                    echo 'Upload fail!';
               }
          }
          else
          {
               echo $erreur;
          }
} else {
     echo 'You are not an authorized user.';
}


function createthumb($name,$filename,$new_w,$new_h)
{
     $system=explode(".",$name);
     if (preg_match("/jpg|jpeg/",$system[1])){$src_img=imagecreatefromjpeg($name);}
     if (preg_match("/gif/",$system[1])){$src_img=imagecreatefromgif($name);}
     if (preg_match("/png/",$system[1])){$src_img=imagecreatefrompng($name);}
     $old_x=imageSX($src_img);
     $old_y=imageSY($src_img);
     if ($old_x > $old_y) 
     {
          $thumb_w=$new_w;
          $thumb_h=floor($old_y*$new_w/$old_x);
     }
     if ($old_x < $old_y) 
     {
          $thumb_w=floor($new_h*$old_x/$old_y);
          $thumb_h=$new_h;
     }
     if ($old_x == $old_y) 
     {
          $thumb_w=$new_w;
          $thumb_h=$new_h;
     }
     $dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
     imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
     if (preg_match("/png/",$system[1]))
     {
          imagepng($dst_img,$filename); 
     } else {
          imagejpeg($dst_img,$filename); 
     }
     imagedestroy($dst_img); 
     imagedestroy($src_img); 
}


?>