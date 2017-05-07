</div>

<script src="/stp/pub/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="/stp/pub/js/jquery.md5.js" type="text/javascript"></script>
<script src="/stp/pub/js/jquery.js" type="text/javascript"> </script>

<footer>

   <div class="panel panel-light">
       <div class="panel-body">
           <p class="text-muted">
           <?= $this->version; ?>
            -
	<?= $this->title; ?>
            - Olalla Iglesias - M7 2DAW</p>
	<?php
  if(isset($this->msg)){
		echo $this->msg;
	}
  ?>

       </div>
  </div>

</footer>
</body>
</html>
