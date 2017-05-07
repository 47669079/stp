<?php
            include 'head_common.php';
?>

<div id="mens"></div>

  <label class="editor_title">Título:</label><br>
  <input type="text" name="titulo" class="title"><br><br>
  <label class="editor_title">Historia:</label><br>
  <textarea id="textarea"></textarea>

  <br>
  <button type="submit" id="editor_save" >Guardar história</button>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=2p9jngt9k4v3upcejv4rq3vzq2wxp5xyig3mqt47q9xj4ji6"></script>

<script type="text/javascript">
tinymce.init({ selector:'#textarea' });
</script>

<?php
            include 'footer_common.php';
?>
