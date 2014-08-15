<?php

$model_tsth = new TsthStatusHistory();
$model_tsth->tsth_ttsk_id = $model->primaryKey;

// render grid view

$this->widget('TbGridView', array(
    'id' => 'tsth-status-history-grid',
    'dataProvider' => $model_tsth->search(),
    'template' => '{summary}{items}',
    'summaryText' => '&nbsp;',
    'htmlOptions' => array(
        'class' => 'rel-grid-view'
    ),
    'columns' => array(
        array(
            'name' => 'tsth_datetime',
        ),
        array(
            'name' => 'tsth_tstt_id',
            'value' => '(empty($data->tsth_tstt_id)) ? "" : $data->tsthTstt->tstt_name',
        ),
        array(
            'name' => 'tsth_pprs_id',
            'value' => '(empty($data->tsth_pprs_id)) ? "" : $data->tsthPprs->itemLabel',
        ),
    )
        )
);
