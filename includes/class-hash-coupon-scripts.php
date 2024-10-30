<?php 
/**
 * The script class for the plugin
 *
 *
 * @since    1.0.3
 *
 * @package   HashCoupon
 * @author    Hashcrypt Technology
 * @license   http://www.gnu.org/licenses/gpl-2.0.txt
 * @link      https://hashcrypt.com/
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * HashCouponScript Model has logic of loading in scripts to various pages of the plugin.
 *
 * @since 1.0.3
 */

class HashCouponScript
{

    /**
     * Property that holds the single main instance of HashCouponScript.
     *
     * @since 1.0.3
     * @access private
     * @var HashCouponScript
     */
    private static $_instance;

    /*
    |--------------------------------------------------------------------------
    | Class Methods
    |--------------------------------------------------------------------------
     */

    /**
     * HashCouponScript constructor.
     *
     * @since 1.0.3
     * @access public
     *
     */
    public function __construct()
    {
       $this->version = '1.0.3';
       add_action('wp_enqueue_scripts',array($this,'enqueue_hashcoupon'));
       add_action('admin_enqueue_scripts', array($this,'hashcoupon_admin_css_and_js'));
    }

    /**
     * Ensure that only one instance of HashCouponScript is loaded or can be loaded (Singleton Pattern).
     *
     * @since 1.0.3
     * @access public
     *
     * @return HashCouponScript
     */
    public static function getInstance(){
        if (!self::$_instance instanceof self) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    function enqueue_hashcoupon(){
         
        // Pre-Defined CSS and JS
        wp_enqueue_script('jquery');

        //Plugin CSS and JS
		wp_register_style( 'hashcoupon-modal', HWC_CSS_PATH.'hashmodal.css',array(),'1.0.3');
        wp_enqueue_style('hashcoupon-modal');
        wp_register_script('hashcoupon-modal',HWC_CSS_PATH.'hashmodal.js',array(),'1.0.3');
        wp_enqueue_script('hashcoupon-modal');
        if(get_option('hash_status') == 'on'){
           if(is_checkout()){
               wp_deregister_script('wc-checkout');
               wp_deregister_script('wc-checkout-js');
               wp_enqueue_style('hash-checkout-styles', HWC_CSS_PATH.'hashcoupon_woo.css');
               wp_enqueue_script('hashcoupon-wc-checkout',HWC_TEMPLATE_PATH.'woocommerce/js/checkout.js', array('jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n'), null, true);
            }
        }
    }

    function hashcoupon_admin_css_and_js(){ 
        wp_enqueue_style('hash-admin-styles', HWC_CSS_PATH.'hashcoupon.css');
    }

}