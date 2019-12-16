<article>
	<?php if (!empty($userMessage)): ?>
		<h2 class="item title"><?= $userMessage; ?></h2>
	<?php else: ?>
		<h2 class="item title"><?= $exception->getMessage(); ?></h2>
	<?php endif; ?>
</article>
