// add product to cart when total cart amount is reached and remove item from cart after falling under specified amount

add_action( 'template_redirect', 'add_product_to_cart' );
function add_product_to_cart() {
  if ( ! is_admin() ) {
		global $woocommerce;
		$product_id = 433609;
		$found = false;
		$cart_total = 49;
	  
		if( $woocommerce->cart->total >= $cart_total ) {
			//check if product already in cart
			if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
				foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
					$_product = $values['data'];
					if ( $_product->get_id() == $product_id )
						$found = true;
				}
				// if product not found, add it
				if ( ! $found )
					$woocommerce->cart->add_to_cart( $product_id );
			} else {
				// if no products in cart, add it
				$woocommerce->cart->add_to_cart( $product_id );
			}
		}
	    else {
	    foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
            if ( $cart_item['product_id'] == $product_id ) {
                $woocommerce->cart->remove_cart_item( $cart_item_key );
                }
            }
		}
	}
}
