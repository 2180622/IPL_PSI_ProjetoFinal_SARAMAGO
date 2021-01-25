<?php

$this->title = $model->titulo . ' ('. $model->ano .')';
$this->params['breadcrumbs'][] = ['label' => 'Obras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;