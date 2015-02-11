<?php
/**
 * @link http://www.agence-inspire.com/
 */

namespace inspire\action;

use Yii;
use yii\base\Action;
use yii\web\Response;

/**
 * The ajax new action. 
 * 
 * Handles form submitting.
 * 
 * @author Mehdi Achour <mehdi.achour@agence-inspire.com> 
 */
class AjaxNewAction extends Action {

    /**
     * @var yii\db\ActiveRecord The model instance
     */
    public $model = null;
    /**
     * @var string The attribute name for the model id
     */
    public $attr_id = 'id';
    /**
     * @var string The attribute name for the model label. Defaults to __toString()
     */
    public $attr_label = null;
    /**
     * @var string The view file holding the form. It must use the $model variable for the model instance
     */
    public $viewFile = null;

    /**
     * 
     */
    public function run()
    {
        $this->controller->layout = false;

        if ($this->model->load(Yii::$app->request->post()) && $this->model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'id' => $this->model->{$this->attr_id},
                'label' => is_null($this->attr_label) ? (string)$this->model : $this->model->{$this->attr_label},

            ];
        }

        return $this->controller->render($this->viewFile, [
            'model' => $this->model,
        ]);
    }

}