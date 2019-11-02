<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1 class="page-header">States <a class="btn btn-primary pull-right" href="/index.php?r=states/form">check</a></h1>



<?php if(!empty($states)) : ?>
<ul>
	<?php foreach($states as $state) : ?>
		<li class="list-group-item"><a href="/index.php?r=states/lgapage&id=<?= $state->state_id ?>"><?= $state->state_name; ?></a></li>
	<?php  endforeach; ?>
</ul>

<?php else: ?>

<p>No states</p>


<?php endif; ?>
<?= LinkPager::widget(['pagination'=>$pagination]);?>