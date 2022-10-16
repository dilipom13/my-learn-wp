<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package mlt
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Take some variable
global $post;
$prefix = MLT_META_PREFIX; // Metabox prefix


// Getting meta values
$faq_control         		= get_post_meta( $post->ID, $prefix.'faq_control', true );
$faq_control		 		= !empty($faq_control) ? $faq_control : array( '1' => '' );

?>
<!-- Addon configuration -->
<div class="faq-control-wrap">
	<div class="sh-add-pdt-file-rpt-row">
		<button type="button" class="button-primary sh-add-faq-repeatable"><?php _e('Add New', 'mlt'); ?></button>
	</div>
	<div class="faq-control-repeater" >
		<?php 
			$fqa_counter = 1;
			if( !empty( $faq_control ) ) {
			foreach ($faq_control as $v_key => $v_data) { 

				$faq 			= !empty($v_data['faq'])?$v_data['faq']:''; 
				$faq_ans 		= !empty($v_data['faq_ans'])?$v_data['faq_ans']:'';

				//echo $faq.'<br/>';
				//echo $faq_ans.'<br/>';

				?>
		<div class="sh-pdt-file-rpt-upload-wrapper wpos-faq" data-key="<?php echo $v_key;?>">
			<div class="sh-pdt-file-rpt-row-header ui-sortable-handle">
				<span class="sh-pdt-file-rpt-row-title" title="Click and drag to re-order files">
					FAQ 
				</span>
				<span class="sh-pdt-file-rpt-row-actions">
					<a class="full-faq-remove sh-remove-row sh-delete">Remove</a>
				</span>
			</div>
			<div class="sh-pdt-file-rpt-row-standard-fields">
				<table class="form-table">
					<tbody>			
						<!--Version-->	
					<tr valign="top">
						<th scope="row">
							<label for="wpos-faq-<?php echo $v_key;?>"><?php _e('Title', 'mlt'); ?></label>
						</th>
						<td>
							<input type="text" name="<?php echo $prefix; ?>faq_control[<?php echo $v_key;?>][faq]" value="<?php echo mlt_esc_attr($faq); ?>" id="wpos-faq-<?php echo $v_key;?>" class="large-text wpos-faq" /><br/>
							<span class="description"><?php _e( 'Enter FAQ.', 'mlt' ); ?></span>
						</td>
					</tr>
					<!--Last update Date-->	
					<tr valign="top">
						<th scope="row">
							<label for="wpos-faq_ans-<?php echo $v_key;?>"><?php _e('Answer', 'mlt'); ?></label>
						</th>
						<td>
							<textarea id="wpos-faq_ans-<?php echo $v_key;?>" class="large-text wpos-faq_ans" name="<?php echo $prefix; ?>faq_control[<?php echo $v_key;?>][faq_ans]"><?php echo mlt_esc_attr($faq_ans); ?></textarea>
							<span class="description"><?php _e( 'Enter FAQ Answers.', 'mlt' ); ?></span>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
	</div>
	<?php } } ?>
	</div>
</div>
