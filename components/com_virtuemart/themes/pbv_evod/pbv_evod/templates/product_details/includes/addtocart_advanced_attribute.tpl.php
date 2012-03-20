<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 

if ($this->get_cfg('inlineForm') == 0) {
	foreach($attributes as $attribute) { 		
		?>
		<div class="vmAttribChildDetail" style="width:95%;">
			<label for="<?php echo $attribute['titlevar'] ?>_field"><?php echo $attribute['title'] ?></label>:
		</div><br style="clear:both">
		<div class="vmAttribChildDetail" style="width:95%;">
			<select class="inputboxattrib" id="<?php echo $attribute['titlevar'] ?>_field" name="<?php echo $attribute['titlevar'].$attribute['product_id'] ?>">
			<?php foreach ( $attribute['options_list'] as $options_item ) : ?>
				<?php if( isset( $options_item['display_price']) ) : ?>
				<option value="<?php echo $options_item['base_var'] ?>"><?php echo $options_item['base_value'] ?> (<?php echo $options_item['sign'].$options_item['display_price'] ?>)</option>
				<?php else : ?>
				<option value="<?php echo $options_item['base_var'] ?>"><?php echo $options_item['base_value'] ?></option>
				<?php endif; ?>
			<?php endforeach; ?>
			</select>
		</div>
		<br style="clear:both;" />
		
	<?php 
	} 
} else {

foreach($attributes as $attribute) { 		
    ?>
    <div class="vmAttribChildDetail">
        <select class="inputboxattrib" id="<?php echo $attribute['titlevar'] ?>_field" name="<?php echo $attribute['titlevar'].$attribute['product_id'] ?>">
		<option value="<?php echo $attribute['title'] ?>"><?php echo $attribute['title'] ?></option>
		<?php foreach ( $attribute['options_list'] as $options_item ) : ?>
	        <?php if( isset( $options_item['display_price']) ) : ?>
	        <option value="<?php echo $options_item['base_var'] ?>"><?php echo $options_item['base_value'] ?> (<?php echo $options_item['sign'].$options_item['display_price'] ?>)</option>
	        <?php else : ?>
	        <option value="<?php echo $options_item['base_var'] ?>"><?php echo $options_item['base_value'] ?></option>
	        <?php endif; ?>
        <?php endforeach; ?>
        </select>
    </div>
    
	<?php 
	} 
}
?>