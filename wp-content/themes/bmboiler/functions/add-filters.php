<?php
  
  // Change gravity form submit input to a button tag
  add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
  function form_submit_button( $button, $form ) {
    return "<button class='button gform_button btn' id='gform_submit_button_{$form['id']}'>Submit</button>";
  }

?>
