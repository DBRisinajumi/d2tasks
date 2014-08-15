<?php


class TcmnCommunicationController extends Controller
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
            'actions' => array('create', 'admin', 'view', 'update', 'editableSaver', 'delete','ajaxCreate'),
            'roles' => array('D2tasks.TcmnCommunication.*'),
        ),
        array(
            'allow',
            'actions' => array('create','ajaxCreate'),
            'roles' => array('D2tasks.TcmnCommunication.Create'),
        ),
        array(
            'allow',
            'actions' => array('view', 'admin'), // let the user view the grid
            'roles' => array('D2tasks.TcmnCommunication.View'),
        ),
        array(
            'allow',
            'actions' => array('update', 'editableSaver'),
            'roles' => array('D2tasks.TcmnCommunication.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2tasks.TcmnCommunication.Delete'),
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

    public function actionView($tcmn_id, $ajax = false)
    {
        $model = $this->loadModel($tcmn_id);
        if($ajax){
            $this->renderPartial('_view-relations_grids', 
                    array(
                        'modelMain' => $model,
                        'ajax' => $ajax,
                        )
                    );
        }else{
            $this->render('view', array('model' => $model,));
        }
    }

    public function actionCreate()
    {
        $model = new TcmnCommunication;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'tcmn-communication-form');

        if (isset($_POST['TcmnCommunication'])) {
            $model->attributes = $_POST['TcmnCommunication'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'tcmn_id' => $model->tcmn_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('tcmn_id', $e->getMessage());
            }
        } elseif (isset($_GET['TcmnCommunication'])) {
            $model->attributes = $_GET['TcmnCommunication'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($tcmn_id)
    {
        $model = $this->loadModel($tcmn_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'tcmn-communication-form');

        if (isset($_POST['TcmnCommunication'])) {
            $model->attributes = $_POST['TcmnCommunication'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'tcmn_id' => $model->tcmn_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('tcmn_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionEditableSaver()
    {
        $es = new EditableSaver('TcmnCommunication'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value) 
    {
        $model = new TcmnCommunication;
        $model->$field = $value;
        try {
            if ($model->save()) {
                return TRUE;
            }else{
                return var_export($model->getErrors());
            }            
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }
    }
    
    public function actionDelete($tcmn_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($tcmn_id)->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!isset($_GET['ajax'])) {
                if (isset($_GET['returnUrl'])) {
                    $this->redirect($_GET['returnUrl']);
                } else {
                    $this->redirect(array('admin'));
                }
            }
        } else {
            throw new CHttpException(400, Yii::t('D2tasksModule.crud', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    public function actionAdmin()
    {
        $model = new TcmnCommunication('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['TcmnCommunication'])) {
            $model->attributes = $_GET['TcmnCommunication'];
        }

        $this->render('admin', array('model' => $model));
    }

    public function loadModel($id)
    {
        $m = TcmnCommunication::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tcmn-communication-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
