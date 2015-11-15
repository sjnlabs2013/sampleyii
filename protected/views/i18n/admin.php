<?php
/* @var $this I18nSourceMessageController */
/* @var $model I18nSourceMessage */
$themeUrl = Yii::app()->theme->baseUrl;

$this->breadcrumbs=array(
    'I18n'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'Create I18N', 'url'=>array('create')),
);
?>

<h1>Manage I18n Source Messages</h1>

<h4>Source</h4>
<div id="source">
<?php 
$this->widget('JGridView', array(
    'id'=>'i18n-source-message-grid',
    'dataProvider'=>$model->search(10),
    
    //'afterAjaxUpdate'=>'js:function(id,data){alertify.log("id="+id+" data:"+data);}',
    'ajaxUpdate'=>'translations',
    'ajaxUpdate'=>'i18n-translated-message-grid',
    //'ajaxType'=>'POST', //Default Value GET
    //'ajaxUpdateError'=>'function(xhr, textStatus, errorThrown, errorMessage){ $("#"+id).text(err); }',
    'filter'=>$model,
    'columns'=>array(
        array(
            'name'=>'id',
            'htmlOptions'=>array('class'=>'id-column')
        ),

        array(
            'name'=>'category',
            'htmlOptions'=>array('class'=>'c50-column')
        ),
        
        'message',
        array(
            'class'=>'CButtonColumn',
            
            'template' => '{filter} {update} {delete}',
            
            //'viewButtonImageUrl' => $themeUrl . '/images/view16x16.png',
            'updateButtonImageUrl' => $themeUrl . '/images/update16x16.png',
            'deleteButtonImageUrl' => $themeUrl . '/images/delete16x16.png',
            
            'updateButtonUrl' => 'array("i18n/update","id"=>$data->id)',
            //'updateButtonUrl' => 'array("i18n/updateSource","id"=>$data->id)',
            'deleteButtonUrl' => 'array("i18n/deleteSource","id"=>$data->id)',
            'afterDelete' => 'function(link,success,data){ '
            . 'if(success) $("#i18n-translated-message-grid").html(data); '
            . '}',
            
            'deleteConfirmation' => Yii::t('ui','Do you really want to delete this item?'),
            'afterDelete' => 'function(link,success,data){ '
            . 'if(success){ alertify.log("Record Deleted","success",7000); } '
            . '}',          
            
            'buttons' => array (
                'filter' => array (
                    'label' => 'Filter',
                    //'url' => 'Yii::app()->createUrl(\'i18n/index\', array(\'id\'=>$data->id))',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/filter_13x13.png',
                    'options'=>array('class'=>'f'),
                    'click'=>'function(){'
                    
                    //. '$(\'#i18n-translated-message-grid\').yiiGridView(\'update\');'
                    
                    //. 'var model=\'I18nTranslatedMessage\', field=\'id\', param=1, grid=\'i18n-translated-message-grid\';'
                    //. '$(\'input[name=\' + model + \'\\\\[\' + field + \'\\\\]]\').val(param);'
                    //. '$.fn.yiiGridView.update(grid, {data: $.param($("#" + grid + " .filters input, #" + grid + " .filters select"))});'                    

                    
                    . 'filterDetailGrid( $(this).closest("tr").find("td.id-column").text() );'
                                          
                    . 'return false;'
                    . '}',
                    
                    //'visible'=>'',
                ),
            )                
        ),
    ),
)); 
?>
</div>

<h4>Translation</h4>
<div id="translations">
<?php 

$this->widget('JGridView', array(
    'id'=>'i18n-translated-message-grid',
    'dataProvider'=>$detail->search(20),
    'filter'=>$detail,
    'columns'=>array(
        array(
            'name'=>'id',
            'htmlOptions'=>array('class'=>'id-column')
        ),
        
        array(
            'name'=>'language',
            'htmlOptions'=>array('class'=>'c10-column')
        ),
        'translation',
        //array(            
        //    'class'=>'CButtonColumn',
        //
        //    'template' => '{update} {delete}',
        //
        //    //'viewButtonImageUrl' => $themeUrl . '/images/view16x16.png',
        //    'updateButtonImageUrl' => $themeUrl . '/images/update16x16.png',
        //    'deleteButtonImageUrl' => $themeUrl . '/images/delete16x16.png',
        //
        //    'updateButtonUrl' => 'array("i18n/updateTranlation","id"=>$data->id)',
        //    'deleteButtonUrl' => 'array("i18n/deleteTranlation","id"=>$data->id)',
        //    'afterDelete' => 'function(link,success,data){ '
        //    . 'if(success) $("#i18n-translated-message-grid").html(data); '
        //    . '}',
        //
        //    'deleteConfirmation' => Yii::t('ui','Do you really want to delete this item?'),
        //    'afterDelete' => 'function(link,success,data){ '
        //    . 'if(success){ alertify.log("Record Deleted","success",7000); } '
        //    . '}',   
        //
        //),
    ),
)); 
?>
</div>


<?php 

?>


<script>
var model='I18nTranslatedMessage', 
    field='id', 
    param=0, 
    //grid='i18n-translated-message-grid'
    grid='i18n-translated-message-grid'
    ;
    
function filterDetailGrid(param){
$('input[name=' + model + '\\[' + field + '\\]]').val(param);
$.fn.yiiGridView.update(grid, {data: $.param($("#" + grid + " .filters input, #" + grid + " .filters select"))});
}
</script>