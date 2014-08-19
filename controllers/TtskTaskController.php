<?php


class TtskTaskController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";
    public $menu_route = "d2tasks/ttskTask";


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
            'roles' => array('D2tasks.TtskTask.*'),
        ),
        array(
            'allow',
            'actions' => array('create','ajaxCreate'),
            'roles' => array('D2tasks.TtskTask.Create'),
        ),
        array(
            'allow',
            'actions' => array('view', 'admin'), // let the user view the grid
            'roles' => array('D2tasks.TtskTask.View'),
        ),
        array(
            'allow',
            'actions' => array('update', 'editableSaver'),
            'roles' => array('D2tasks.TtskTask.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2tasks.TtskTask.Delete'),
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

    public function actionView($ttsk_id, $ajax = false)
    {
        $model = $this->loadModel($ttsk_id);
        if($ajax == 'tsth-status-history-grid'){
            $this->renderPartial('_tsth_grid',array('model'=>$model));
        }elseif($ajax == 'tcmn-communication-grid'){

            $this->renderPartial('_tcmn_grid',array('model'=>$model));
        }elseif($ajax){
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
        $model = new TtskTask;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ttsk-task-form');

        if (isset($_POST['TtskTask'])) {
            $model->attributes = $_POST['TtskTask'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ttsk_id' => $model->ttsk_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ttsk_id', $e->getMessage());
            }
        } elseif (isset($_GET['TtskTask'])) {
            $model->attributes = $_GET['TtskTask'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($ttsk_id)
    {
        $model = $this->loadModel($ttsk_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ttsk-task-form');

        if (isset($_POST['TtskTask'])) {
            $model->attributes = $_POST['TtskTask'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ttsk_id' => $model->ttsk_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ttsk_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionEditableSaver()
    {
        $es = new EditableSaver('TtskTask'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value) 
    {
        $model = new TtskTask;
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
    
    public function actionDelete($ttsk_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($ttsk_id)->delete();
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
        $model = new TtskTask('search_ext');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['TtskTask'])) {
            $model->attributes = $_GET['TtskTask'];
        }

        if (isset($_GET['ajax'])) {
            $this->renderPartial('admin', array(
                'model' => $model,
                'ajax' => true,
                ));            
        }else{
            $this->render('admin', array(
                'model' => $model,
                'ajax' => false,
                ));            
        }
    }

    public function loadModel($id)
    {
        $m = TtskTask::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ttsk-task-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
