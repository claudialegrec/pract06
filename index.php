<?php

#Listado de archivos en existencia

$listar = null;
$directorio=opendir("docs/");

while ($elemento = readdir($directorio))
{
  if ($elemento != '.' && $elemento != '..')
  {
  if (is_dir("docs/".$elemento))
  {
    $listar .="<a class=' col-md-6' href='docs/$elemento' target='_blank'> 
    $elemento/</a>
    <br><br>";
  }
  else
  {
     $listar .="<a class=' col-md-6' href='docs/$elemento' target='_blank'> 
    $elemento</a>
    <br><br>";
  }
  }
}
echo $listar;

#Subida de archivos
if ($_POST["subir"] == "Upload file")
{
$folder = "docs/";
move_uploaded_file($_FILES["formato"]["tmp_name"] , "$folder".$_FILES["formato"]["name"]);
echo "<div class='alert alert-success'><p class='hidd' align=center>File ".$_FILES["formato"]["name"]." was uploaded successfully.<a href='index.php' class='btn btn-default'> Click </a> para verificar.</div>";
}

#Borrado de archivos

$borrarFor=($_POST['borrarFor']);
if (isset($_POST['borrar']))
{
@unlink('docs/'.$borrarFor);
echo "
<div class='alert alert-danger'><p class='hidd' align=center>File ".$_FILES["formato"]["name"]." was deleted successfully. <a href='index.php' class='btn btn-default'> Click here </a> para verificar.</div>";
}
?>


<html lang="es">

  <head>
    <title>Enlistar, Cargar y Eliminar Ficheros en el Servidor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  </head>

  <body>
    <header>
      <br>
      <div class="alert alert-info"></div>
    </header>

    <div class="col-md-offset-4">
    <?
    echo $listar;
    ?>
    </div>

    <form  method="post" enctype="multipart/form-data" class="col-md-offset-4 col-md-4" style="margin-right:2%; border-radius:20px;">

      <div class="bg-success" style="margin-top:2%; margin-bottom:20%; padding:3%; border-radius:20px;">
        <input  class="form-control" type="file" name="formato" id="formato" style="margin-bottom:2%;">
        <input  class="btn btn-default" type="submit" name="subir" value="Upload file" style="width:100%;">
        </div>
    </form>

    <form method="post" class="col-md-offset-4 col-md-4"  style="margin-right:2%; margin-top:-7%; " >
      <div class="bg-danger" style="margin-top:2%; margin-bottom:20%; padding:3%; border-radius:20px;">
        <input class="form-control" name="borrarFor" size="50" placeholder="Name of the file you want to delete" style="margin-bottom:2%;"/>
        <input  class="btn btn-default" type="submit" name="borrar" value="Delete file" style="width:100%;">

        <div class="col-md-6" style="margin-top:1%;"></div>
        <br><br>
      </div>
    </form>
  </body>
</html>