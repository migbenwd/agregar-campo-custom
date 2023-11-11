
add_action( 'woocommerce_admin_order_data_after_order_details', 'add_user_custom_url_field_to_order' );
function add_user_custom_url_field_to_order( $order ) {
    global $current_user;
	global $post;

    $custom_url = get_post_meta( $post->ID, 'custom_URL', true );
	
    ?>
    <form method="post">
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="custom_URL"><?php _e( 'URL', 'woocommerce' ); ?></label>
            <input type="text" name="custom_URL" id="custom_URL" value="<?php echo $custom_url; ?>" />
        </p>
		<!--
        <input type="submit" name="submit-custom_URL" value="<?php _e('RUN', 'woocommerce'); ?>" /><br/>
		-->
    </form>
    <?php
}

add_action( 'woocommerce_order_actions', 'add_custom_order_action' );
function add_custom_order_action( $actions ){
    $actions['my_custom_action'] = __('My custom action', 'WooCommerce');
    return $actions;
}

add_action( 'woocommerce_order_action_my_custom_action', 'triggered_custom_order_action' );
function triggered_custom_order_action( $order ){
    //$order->update_meta_data( '_test_1_custom_field', 'AAFFBB9977' );
    //$order->save();

    if( isset($_POST['custom_URL']) ){
	update_post_meta( $order->get_id(), 'custom_URL', $_POST['custom_URL'] );
	}	
	
	
}
