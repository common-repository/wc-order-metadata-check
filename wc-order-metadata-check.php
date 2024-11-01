<?php
/**
 * Plugin Name: WC Order Metadata Check
 * Description: Get the metadata list from your WooCommerce order
 * Plugin URI: https://fernandoacosta.net
 * Author: Fernando Acosta
 * Author URI: https://fernandoacosta.net
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: wc-order-metadata-check
 */

/*
    Copyright (C) 2018  Fernando Acosta  contato@fernandoacosta.net

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_filter( 'woocommerce_admin_status_tabs', 'wc_admin_status_order_debug_tab' );
function wc_admin_status_order_debug_tab( $tabs ) {
  $tabs['order_debug'] = 'Order Metadata';

  return $tabs;
}

add_action( 'woocommerce_admin_status_content_order_debug', 'wc_admin_status_order_debug_tab_content' );
function wc_admin_status_order_debug_tab_content() { ?>

  <form action="<?php echo admin_url( 'admin.php?page=wc-status&tab=order_debug' ); ?>" method="POST">
    <label>Número do pedido</label>
    <input type="number" value="<?php echo isset( $_POST['order_number'] ) ? $_POST['order_number'] : '' ?>" name="order_number" />

    <input type="submit" name="" value="Ver detalhes" class="button" />

    <?php if ( isset( $_POST['order_number'] ) ) { ?>
      <p class="description">Para copiar o texto abaixo, clique dentro do texto, selecione tudo (CTRL + A) e salve o resultado <a href="http://pastebin.com" target="_blank">pastebin.com</a> para compartilhar.</p>
      <textarea style="overflow: auto; border-radius: 3px; background: #eee; padding: 15px 25px; font-family: 'Courier 10 Pitch', Courier, monospace; max-width: 100%; border: 1px solid #ddd; width: 100%; height: 500px; resize: none; margin-top: 25px;">
        <?php print_r( get_post_meta( intval( $_POST['order_number'] ), array(), true ) ); ?>

        <?php do_action( 'fa_order_debug_result', intval( $_POST['order_number'] ) ); ?>
      </textarea>
    <?php } ?>
  </form>

<?php }
