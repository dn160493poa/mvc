<?php

use dto\Reporting;
use exceptions\BaseException;
use models\Model_Request;
use models\ParseCsv;

class Controller_Upload extends Controller
{
    private ParseCsv $parseCsv;

    private Reporting $reporting;

    private Model_Request $model_Request;

    public function __construct()
    {
        parent::__construct();

        $this->parseCsv = new ParseCsv();

        $this->reporting = new Reporting();

        $this->model_Request = new Model_Request();
    }

    public function action_index()
    {
        try {
            $this->model_Request->validateOrException(
                $_SERVER['REQUEST_METHOD'],
                $_FILES
            );

            $containers = $this->parseCsv->createContainerOfCalls($_FILES['file']['tmp_name']);

            $this->view->generate('uploaded_view.php', 'template_view.php', [
                'container' => $this->reporting->getReportingOfCustomers($containers)
            ]);
        } catch (BaseException $unprocessable_entity_exception) {
            Route::ErrorPage($unprocessable_entity_exception->getCode());
        }
    }


}