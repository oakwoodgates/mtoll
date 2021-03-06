<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();
?>

<?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>

<?php
// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<?php
			//	$p1['products'] = '13354';
			//	$p2['products'] = '13347';
			//	WooFunnels_pb::woofunnels_offer_block( $p1, 'maia-lunar-lounge-table' );
			//	$p2['products'] = '13594,13593';
			//	$p2['products'] = get_post_meta( get_the_ID(), 'woofunnels_products_to_display', true );
			//	WooFunnels_pb::woofunnels_offer_block( $p2, 'first-promo-block' );
			//	WooFunnels_pb::woofunnels_offer_block( $p2, 'product-single' );
			//	$p2['products'] = '13594,13593,13746';
			//	WooFunnels_pb::woofunnels_offer_block( $p2, 'product-single' );
			?>

				<div id="wf-messages"></div>
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				<?php // do_action( 'woocommerce_checkout_shipping' ); ?>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>

				<?php endif; ?>

				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>


		</div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
