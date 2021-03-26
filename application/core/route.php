<?php
class Route
{
    public static function start()
    {
        $controller_name = 'main';
        $action_name = 'index';
        
            $url = $_SERVER['REQUEST_URI'];
            $routes = [];
            $routes = explode('/', $url);
            $routes = $routes[count($routes)-1];
            
            if(!empty($routes)){
                $controller_name = $routes;
            }

            $model_name = 'model_'.$controller_name;
            $controller_name = 'controller_'.$controller_name;
            $action_name = 'action_'.$action_name;
    
            $model_file = $model_name.'.php';
            $model_path = "application/models/".$model_file;

            //echo "<br>model ". $model_name;
            //echo "<br>controller ". $controller_name;
            //echo "<br>action ". $action_name;

            if(file_exists($model_path)){
                include "application/models/".$model_file; 
                //echo "<br>file OK".$model_path;
            }
            else 
            {
                Route::ErrorPage404();
            }
    
            $controller_file = strtolower($controller_name).'.php';
            $controller_path = "application/controllers/".$controller_file;
    
            if(file_exists($controller_path)){
                include "application/controllers/".$controller_file;
                //echo "<br>file OK".$controller_path;
            }
            else 
            {
                Route::ErrorPage404();
            } 

            $controller = new $controller_name;
            $action = $action_name;

            $controller -> $action();

            
    }

    function ErrorPage404() {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.x 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }


}
?>