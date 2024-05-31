<?php
/**
 * Plugin Name: Woocommerce Cancel Order Alert
 * Description: Adds an alert when attempting to cancel an order in WooCommerce.
 * Version: 1.0
 * Author: Phoenix Ignited Tech
 * Author URI: https://phoenixignited.tech
 * License: GPL3
 */

 // Exit if accessed directly
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
 
// Function to add cancel order alert script and styles
function add_cancel_order_alert() {
    if (is_account_page() && is_wc_endpoint_url('orders')) {
        ?>
        <style>
            /* Custom modal styles */
            .cancel-order-modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.4);
            }
            .cancel-order-modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 500px;
                text-align: center;
            }
            .cancel-order-modal button {
                margin: 10px;
                padding: 10px 20px;
                border: none;
                background-color: #dc3232;
                color: white;
                cursor: pointer;
            }
            .cancel-order-modal button:hover {
                background-color: #c22a2a;
            }
            .cancel-order-modal button.cancel {
                background-color: #0085ba;
            }
            .cancel-order-modal button.cancel:hover {
                background-color: #0073aa;
            }
        </style>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var cancelButtons = document.querySelectorAll('a.button.cancel');
                cancelButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        showModal(button.href);
                    });
                });

                function showModal(href) {
                    var modal = document.getElementById('cancel-order-modal');
                    modal.style.display = 'block';
                    var cancelAnywayButton = document.getElementById('cancel-anyway');
                    cancelAnywayButton.onclick = function() {
                        window.location.href = href;
                    }
                }

                var closeModalButtons = document.querySelectorAll('.close-modal');
                closeModalButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        var modal = document.getElementById('cancel-order-modal');
                        modal.style.display = 'none';
                    });
                });
            });
        </script>
        <div id="cancel-order-modal" class="cancel-order-modal">
            <div class="cancel-order-modal-content">
                <p>
                    Cancelling an order does not refund your order. Once an order is cancelled, it is impossible to get a refund without contacting the admin.
                    If you need to request a refund please select the "Request Warranty" button.
                </p>
                <button id="cancel-anyway">Cancel Order</button>
                <button class="close-modal cancel">Do Not Cancel</button>
            </div>
        </div>
        <?php
    }
}
add_action('wp_footer', 'add_cancel_order_alert');
?>
