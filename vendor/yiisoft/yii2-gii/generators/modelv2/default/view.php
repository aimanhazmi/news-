<?php echo "<?php" ;
/* @var $generator yii\gii\generators\modelv2\Generator */
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\<?= $generator->modelClass ?> */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '<?= $generator->modelClass ?>', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
print <<<EOT

<div class="goods-view">

    <h1><?= Html::encode(\$this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => \$model->goods_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => \$model->goods_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => \$model,
        'attributes' => [
            'goods_id',
            'goods_sn',
            'name',
            'goods_number',
            'keywords',
            'goods_brief',
            'goods_desc',
            'goods_thumb',
            'goods_img',
            'market_price',
            'shop_price',
            'promote_price',
            'shop_score',
            'sort',
            'is_best',
            'is_new',
            'is_hot',
            'is_promote',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
EOT;
?>