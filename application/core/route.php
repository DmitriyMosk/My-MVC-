<? 
class Route { 
    public static function run() 
    { 
        $controller; 
        $action;
        $model; 
        /** 
         * Извлекаем из URI наш маршрут
        */
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        $routes_len = count($routes) - 1; 
        //удаляем одну точку маршрута, потому что полагается, что наш сайт находится в корне, а не в папке Modul25
        //Проще говоря: наш route не должен думать, что Modul25 - какой-то компонент сайта
 
        //$routes[0] = "Modul25"; по умолчанию
        if($_GET['debug'] == 1)
        { 
            echo $route[1].'/'.$route[2]; // наши 2 точки 1 - компонент, 2 - действие
        }
        // Если вы в конце URI добавите ?debug=1 увидите эту информацию
        /**
         * Пользователь перешёл на страничку с index.php впервые 
         * Какую страницу открывать по умолчанию первой? 
         * 
         * Кстати, пример базовой ссылки: 
         * 
         * localhost.ru/Modul25 - наш сайт
         * 
         * localhost.ru/Modul25/ - стартовая страница контроллера Main 
         * localhost.ru/Modul25/main/ - прямое обращение к контроллеру main 
         * localhost.ru/Modul25/main/index - то же самое, что и localhost.ru/Modul25/main/ 
         */
        if( ($route[1] === "/" || empty($route[1])) && empty($route[2])) 
        { 
            $controller = 'Main'; 
            $action = 'index'; 
        } 
        else if (!empty($route[1])) 
        { 
            $controller = $route[1]; 

            if(!empty($route[2])) 
                $action = $route[2]; 
        }
        /** 
         * Что после else if ? 
         * если не пустой первый route и если существует action 
         */

        $controller = 'Controller_'.$controller; // Было Controller_Main стало ControllerMain 
        $model = 'Model_'.$model; // Было Model_Main стало ModelMain 
        // за $action будет браться функция из Controller (сразу) 

        $_model_file = strtolower($model).'.php'; 

        $_model_path = "application/models/".$_model_file;
        if(file_exists($_model_path))
        {
            include $_model_path;
        } 
        // Model - необязательная часть компонента(она просто даёт нам какую-то информацию)
      
        // Controller - обязательная, это и есть сама страница 
        $_controller_file = strtolower($controller).'.php';
        $_controller_path = "application/controllers/".$_controller_file;
        if(file_exists($_controller_path))
        {
            include $_controller_path;
        }
        else
        { 
            // Поэтому, если страницы не существует, то возвращаем 404
            Route::ErrorPage404();
        }
        
        // создаем контроллер
        $controller = new $controller;
        $action = $action;
        
        if(method_exists($controller, $action))
        {
            $controller->$action();
        }
        else
        {
            Route::ErrorPage404();
        }
       
    }
       
    static function ErrorPage404()
    {
        echo "404 ERROR";
        //       $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        //       header('HTTP/1.1 404 Not Found');
        // header("Status: 404 Not Found");
        // header('Location:'.$host.'404');
    
    
    }
}