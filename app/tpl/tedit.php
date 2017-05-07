<?php
            include 'head_common.php';
?>

<div id="mens"></div>

  <label class="editor_title">Título:</label><br>
  <input type="text" name="titulo" class="title"><br><br>
  <label class="editor_title">Historia:</label><br>

  <textarea id="textarea"></textarea>

  <br>
  <button type="submit" id="edit_hist" >Editar história</button>

  <?php

      $archivo = $this->dataTable[0]['path'].".json"; //extraemos el path del datable para abrir el json con la informacion
      $archivo2 = $this->dataTable[0]['path'].".txt"; //hacemos lo mismo para extraer la historia

      $data=file_get_contents("stories/".$archivo); //extraemos el json
      //$data2=fopen("stories/".$archivo2,"r");

      $story = json_decode($data, true); //lo transformamos en array

      $gestor = @fopen("stories/".$archivo2, "r"); //Extraemos el archivo de texto
      $contents = fread($gestor, filesize("stories/".$archivo2)); //guardamos la info en una variable

      //guardamos toda la informacion en textareas ocultos para luego poder insertarlo en el script

      echo "<textarea style='display:none;' id='story'>".$contents."</textarea>";
      echo "<textarea style='display:none;' id='title'>".$story['titulo']."</textarea>";
      echo "<textarea style='display:none;' id='iduser'>".$this->dataTable[0]['idusers']."</textarea>";
      echo "<textarea style='display:none;' id='idstory'>".$this->dataTable[0]['path']."</textarea>";

  ?>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=2p9jngt9k4v3upcejv4rq3vzq2wxp5xyig3mqt47q9xj4ji6"></script>

<?php
            include 'footer_common.php';
?>
