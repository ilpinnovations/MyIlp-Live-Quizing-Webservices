<?php for ($i = 1; $i <= 10; $i++): ?>
	  <?php sleep(1); ?>
	  Count = <?php echo "$i\n"; ?>
	  <?php ob_flush(); flush(); ?>
	<?php endfor; ?>