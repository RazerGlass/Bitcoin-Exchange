<?php


class Pages extends Controller
{
    
    public function index()
    {
        // load views
        require APP . 'views/_templates/header.php';
        require APP . 'views/_templates/sidebar.php';		
		$id = !empty($_GET['id']) ? $_GET['id'] : 'default';
		$page = $this->model->viewpage($id);
		if($page){
        require APP . 'views/pages/index.php';
		}else{
		require APP . 'views/error/index.php';
		}
        require APP . 'views/_templates/footer.php';
    }



}
