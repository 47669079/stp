<?php

	namespace X\App\Views;

	use \X\Sys\View;

	class vmyStories extends View{


  function __construct($dataView,$dataTable=null){

			parent::__construct($dataView,$dataTable);

			$this->output= $this->render('tmystories.php');

		}

	}
