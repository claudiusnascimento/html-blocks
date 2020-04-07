<?php


if (! function_exists('htmlblocksRelationString')) {

    function htmlblocksRelationString($model) {

        if(method_exists($model, 'getHtmlblocksRelationString')) {
            return $model->getHtmlblocksRelationString();
        }

        if(property_exists($model, 'htmlblocksRelationString')) {
            return $model->htmlblocksRelationString;
        }

        return '';
    }
}
