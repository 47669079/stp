<?php
	include 'head_common.php';
	?>
<body>

      <div class="well cont_story" id="<?=$this->dataTable[0]['path']?>">


            <?php

						use \X\Sys\Session;
						$ses = Session::get('user');

            $archivo = $this->dataTable[0]['path'].".json";
            $archivo2 = $this->dataTable[0]['path'].".txt";

            $data=file_get_contents("stories/".$archivo);
            //$data2=fopen("stories/".$archivo2,"r");

            $story = json_decode($data, true);

						echo "<div id='hist_top'><label class='h_username'>@".$this->dataTable[0]['usersname']."</label>  <button type='button' class='btn btn-warning b_values'><label class='h_value'> <span class='glyphicon glyphicon-star'></span> ".$this->dataTable[0]['medium_value']."</label></button> </div>";
						echo"<div style='display:none'><textarea id='id_user'>".$ses['idusers']."</textarea><textarea id='id_story'>".$this->dataTable[0]['idstories']."</textarea></div>";
						if( $ses['idusers'] == $this->dataTable[0]['idusers'] )
								{ ?>
									<a class="h_edit" href="<?= APP_W."story/edit/user/".$this->dataTable[0]['idusers']."/idstory/".$this->dataTable[0]['idstories'];?>"> editar </a>
									<?php
								}

            echo "<label class='h_date'>".$story['date']."</label>";
            echo "<label class='h_story_title'>".$story['titulo']."</label>";

						$gestor = @fopen("stories/".$archivo2, "r");

						echo"<p id='h_story'>";
						if ($gestor) {
						    while (($búfer = fgets($gestor, 4096)) !== false) {
						        echo $búfer;
						    }
						    if (!feof($gestor)) {
						        echo "Error: fallo inesperado de fgets()\n";
						    }
						    fclose($gestor);
							}
						echo "</p>";

            ?>

						<?php

						if(isset($this->dataTable[0]['nom']))
						{
							echo "<div id='cont_tags'>";

						for($i=0;$i<count($this->dataTable);$i++){

								echo "<button type='button' class='btn btn-info tag_button'>".$this->dataTable[$i]['nom']."</button>";
						}

						 }

							echo "<button type='button' id='new_tag_button' class='btn btn-info tag_button'> + Añadir tag</button> </div>";

						 ?>

    </div> </a>

<?php
	include 'footer_common.php';
?>
