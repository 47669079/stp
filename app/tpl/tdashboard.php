
    <?php
            include 'head_common.php';
            ?>


  <div class="hist_container">


    <?php for($i=0;$i<count($this->dataTable);$i++){ ?>
      <a href="<?= APP_W."story/get/user/".$this->dataTable[$i]['idusers']."/idstory/".$this->dataTable[$i]['idstories'];?>">
          <div class="well cont_hist" id="<?=$this->dataTable[$i]['path']?>">


            <?php

            $archivo = $this->dataTable[$i]['path'].".json";

            $data=file_get_contents("stories/".$archivo);
            $story = json_decode($data, true);

            echo "<div id='hist_top'><label class='h_username'>@".$this->dataTable[$i]['usersname']."</label>  <label class='h_value'> <span class='glyphicon glyphicon-star'></span> ".$this->dataTable[$i]['medium_value']."</label></div>";
            echo "<label class='h_date'>".$story['date']."</label>";
            echo "<label class='h_title'>".$story['titulo']."</label>";

            ?>




    </div> </a>
    <?php } ?>

  </div>

    <?php
            include 'footer_common.php';
    ?>
