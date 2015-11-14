<?php

class TestController extends Controller{
	public function actionIndex()
	{
            
echo '<pre>'; print_r($_POST); echo '</pre>'; 
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
}
