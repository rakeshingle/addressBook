<?php
class defaultController
{
    public function run($action = 'index', $id = 0)
    {
        if (!method_exists($this, $action)) {
            $action = 'index';
        }

        return $this->$action($id);
    }

    public function index()
    {
      include 'View/dashboard.php';
    }
}
?>
