<select class="custom-select col-12 filter-budget" id="budget">
	<option value="any" selected>Any</option>
	<option value="0-<?=$config->budget_min_range-1?>"><?=number_format($config->budget_min_range)?> & below</option>
	<?php 
	$step_temp = ($config->budget_max_range - $config->budget_min_range) / $config->budget_step_count;
	foreach (range($config->budget_min_range, $config->budget_max_range, $step_temp) as $number):
		if($number >= $config->budget_max_range) break;
		$not = count_not_in_chain_string($number,"0");
		$a = round($number,-(strlen($number)-$not));
		$b = round($step_temp,-(strlen($step_temp)-1));
		$next = ($b > $a) ? $b : $a + $b;
		?>
		<option value="<?= $a ?>-<?= $next ?>">between <?=  number_format($a); ?> & <?= number_format($next); ?></option> 
	<?php endforeach; ?>
	<option value="<?=$config->budget_max_range-1?>-<?=PHP_INT_MAX?>"><?=number_format($config->budget_max_range)?> & above</option>
</select>