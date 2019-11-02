<a href="/index.php?r=states">Back to states</a>
<h2 class="page-header"><?=$state->state_name; ?></small>
</h2>

<?php if(!empty($state->lga)) : ?>
	<p>Lga: </p>
<ul class="list-group">
	

	<?php foreach($state->lga as $lga) : ?>
		<li class="list-group-item">
		<?php echo $lga->lga_name; ?>
	</li>
	<?php  endforeach; ?>

</ul>
<?php else: ?>

<p>No Lga under this state in the database </p>


<?php endif; ?>