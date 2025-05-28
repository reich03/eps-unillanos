<?php

class Controller
{
    function __construct()
    {
        $this->view = new View();
    }

    function loadModel(string $model)
    {
        if (!is_string($model)) {
            error_log("Error: loadModel espera un string. Recibido: " . gettype($model));
            return null;
        }

        $url = 'models/' . strtolower($model) . 'model.php';
        error_log("loadModel: buscando archivo modelo: " . $url);

        if (file_exists($url)) {
            require_once $url;
            $modelName = ucfirst($model) . 'Model';
            error_log("loadModel: buscando clase modelo: " . $modelName);

            if (class_exists($modelName)) {
                error_log("loadModel: creando instancia de " . $modelName);
                return new $modelName();
            } else {
                error_log("loadModel error: Clase $modelName no encontrada");
                return null;
            }
        } else {
            error_log("loadModel error: No se encontró el archivo $url");
            return null;
        }
    }



    public function loadController(string $controller)
    {
        if (!is_string($controller)) {
            error_log("Error: loadController espera un string. Recibido: " . gettype($controller));
            return null;
        }

        $url = 'controllers/' . strtolower($controller) . '.php';
        if (file_exists($url)) {
            require_once $url;
            $controllerName = ucfirst($controller);
            if (class_exists($controllerName)) {
                return new $controllerName();
            } else {
                error_log("loadController error: Clase $controllerName no encontrada");
                return null;
            }
        } else {
            error_log("loadController error: No se encontró el archivo $url");
            return null;
        }
    }

    function existPost($params)
    {
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                error_log('Controller::existsPosts-> No existe el parametro ' . $param);
                return false;
            }
        }
        return true;
    }

    function existGet($params)
    {
        foreach ($params as $param) {
            if (!isset($_GET[$param])) {
                error_log('Controller::existsGet-> No existe el parametro ' . $param);
                return false;
            }
        }
        return true;
    }

    function getGet($name)
    {
        return $_GET[$name];
    }

    function getPost($name)
    {
        return $_POST[$name];
    }

    function redirect($route, $messages)
    {
        $data = [];
        $params = '';
        foreach ($messages as $key => $message) {
            array_push($data, $key . '=' . $message);
        }
        $params = join('&', $data);
        if ($params !== '') {
            $params = '?' . $params;
        }
        header('Location: ' . constant('URL') . $route . $params);
    }
}
