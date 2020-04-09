<?php
$form = get_field('form');

?>

<div class="gravity-form">
	<?php if(!empty($form)) : ?>
		<?php render_gravityform( $form ) ?>
	<?php endif; ?>
</div>
