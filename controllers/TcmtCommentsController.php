<?php


class TcmtCommentsController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";


public function filters()
{
    return array(
        'accessControl',
    );
}

public function accessRules()
{
     return array(
        array(
            'allow',
            'actions' => array('ajaxAdd'),
            'roles' => array('D2tasks.TcmtComments.*'),
        ),
        array(
            'allow',
            'actions' => array('ajaxAdd'),
            'roles' => array('D2tasks.TcmtComments.Create'),
        ),
        array(
            'deny',
            'users' => array('*'),
        ),
    );
}

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        if ($this->module !== null) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }
        return true;
    }

    public function actionAjaxAdd() 
    {
        
        if (isset($_POST['TcmtComments'])) {
            $model = new TcmtComments;
            $model->attributes = $_POST['TcmtComments'];

            try {
                if ($model->save()) {
                    return;
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } 
    }

    public function loadModel($id)
    {
        $m = TcmtComments::model();
        // apply scope, if available
        $scopes = $m->scopes();
        if (isset($scopes[$this->scope])) {
            $m->{$this->scope}();
        }
        $model = $m->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('D2tasksModule.crud', 'The requested page does not exist.'));
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tcmt-comments-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
