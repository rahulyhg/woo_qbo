<?php if (!defined('ABSPATH')) exit('Access is Denied');

/**
 * Further get_options and update_options for quickbooks should be added on this class
 *
 * Class LS_QBO_Options
 */
class LS_QBO_Options
{
    protected static $_instance = null;
    public $option_prefix = 'linksync_qbo_';

    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function connection_status()
    {
        return get_option('linksync_status');
    }

    public function save_woocommerce_version($wooVersion)
    {
        return self::instance()->update_option('wooversion', $wooVersion);
    }

    public function get_woocommerce_version()
    {
        return self::instance()->get_option('wooversion', '');
    }


    public function getConnectedTo()
    {
        return get_option('linksync_connectedto', '');
    }

    public function updateConnectedTo($value)
    {
        return update_option('linksync_connectedto', $value);
    }

    public function getConnectedWith()
    {
        return get_option('linksync_connectionwith', '');
    }

    public function updateConnectedWith($value)
    {
        return update_option('linksync_connectionwith', $value);
    }

    public function get_tax_agencies()
    {
        return self::instance()->get_option('tax_agencies', '');
    }

    public function update_tax_agencies($value)
    {
        return self::instance()->update_option('tax_agencies', $value);
    }

    public function setTaxRateAndCodeObjects($lwsApiTaxCodesObject)
    {
        $modifiedTaxCodeAndTaxRateRef = array();

        if (!empty($lwsApiTaxCodesObject)) {

            foreach ($lwsApiTaxCodesObject as $taxCodeObject) {

                if (!empty($taxCodeObject['taxIds'])) {
                    foreach ($taxCodeObject['taxIds'] as $taxRateId){
                        $modifiedTaxCodeAndTaxRateRef['tax_rate_id_'.$taxRateId] = $taxCodeObject;
                    }
                }

                if(!empty($taxCodeObject['id']) && !empty($taxCodeObject['taxIds'])){
                    $modifiedTaxCodeAndTaxRateRef['tax_code_id_'.$taxCodeObject['id']] = $taxCodeObject['taxIds'];
                }
            }
        }

        return self::instance()->update_option('lwsapitaxrateandcoderef', $modifiedTaxCodeAndTaxRateRef);
    }

    public function getTaxRateAndCodeOjects()
    {
        return self::instance()->get_option('lwsapitaxrateandcoderef', null);
    }

    public function getTaxCodeIdByTaxRateId($taxRateId)
    {
        $taxRateAndTaxCodeObjects = self::instance()->getTaxRateAndCodeOjects();
        if (!empty($taxRateId) && !empty($taxRateAndTaxCodeObjects) && isset($taxRateAndTaxCodeObjects['tax_rate_id_' . $taxRateId])) {
            return $taxRateAndTaxCodeObjects['tax_rate_id_' . $taxRateId]['id'];
        }

        return null;
    }

    public function getTaxRateIdsByTaxCodeId($taxCodeId)
    {
        $taxRateAndTaxCodeObjects = self::instance()->getTaxRateAndCodeOjects();

        if (!empty($taxCodeId) && !empty($taxRateAndTaxCodeObjects) && isset($taxRateAndTaxCodeObjects['tax_code_id_' . $taxCodeId])) {

            return $taxRateAndTaxCodeObjects['tax_code_id_' . $taxCodeId];
        }

        return null;

    }
    
    /**
     * @param $jsonShippingProduct Product Details of the Shipping Product in QuickBooks that could have Tax
     * @return bool
     */
    public function updateShippingProductWithTax($jsonShippingProduct)
    {
        return self::instance()->update_option('shipping_with_tax', $jsonShippingProduct);
    }

    /**
     * Get the json Product representation of Shipping Product with tax
     * @return mixed|void
     */
    public function getShippingProductWithTax()
    {
        return self::instance()->get_option('shipping_with_tax');
    }

    public function set_accounts_error_message($message)
    {
        return self::instance()->update_option('accounts_error_msg', $message);
    }

    public function get_accounts_error_message()
    {
        return self::instance()->get_option('accounts_error_msg');
    }


    public function require_syncing($message = 'You have changed your API key and you should resync your products')
    {
        return self::instance()->update_option('require_syncing', $message);
    }

    public function is_require_syncing()
    {
        return self::instance()->get_option('require_syncing');
    }

    public function done_required_sync()
    {
        return self::require_syncing('');
    }

    /**
     * Get if Calculation of taxes was on or off
     * @return mixed|void
     */
    public function woocommerce_calc_taxes()
    {
        return get_option('woocommerce_calc_taxes');
    }

    /**
     * Get woocommerce setting if included of tax was choosen
     * @return mixed|void
     */
    public function woocommerce_prices_include_tax()
    {
        return get_option('woocommerce_prices_include_tax');
    }

    /**
     * Save and return last product update_at key from the product get response plus one second
     *
     * @param null $utc_date_time
     * @return bool|mixed|string|void
     */
    public function last_product_update($utc_date_time = null)
    {
        return self::instance()->last_update('product_last_update', $utc_date_time);
    }

    /**
     * Save and return last order update_at key from the order get response plus one second
     *
     * @param null $utc_date_time
     * @return bool|mixed|string|void
     */
    public function last_order_update($utc_date_time = null)
    {
        return self::instance()->last_update('order_last_update', $utc_date_time);
    }

    public function get_deposit_accounts()
    {
        return self::instance()->get_option('deposit_accounts');
    }

    public function update_deposit_accounts($deposit_accounts)
    {
        return self::instance()->update_option('deposit_accounts', $deposit_accounts);
    }

    public function getQuickBooksInfo()
    {
        return self::instance()->get_option('ls_qbo_info');
    }

    public function updateQuickBooksInfo($quickBooksInfo)
    {
        return self::instance()->update_option('ls_qbo_info', $quickBooksInfo);
    }

    public function updateAssetAccounts($assetsAccounts)
    {
        return self::instance()->update_option('ls_asset_accounts', $assetsAccounts);
    }

    public function getAssetAccounts()
    {
        return self::instance()->get_option('ls_asset_accounts');
    }

    public function getExpenseAccounts()
    {
        return self::instance()->get_option('ls_expense_accounts');
    }

    public function updateExpeseAccounts($expneseAccounts)
    {
        return self::instance()->update_option('ls_expense_accounts', $expneseAccounts);
    }

    public function getIncomeAccounts()
    {
        return self::instance()->get_option('ls_income_accounts');
    }

    public function updateIncomeAccounts($incomeAccounts)
    {
        return self::instance()->update_option('ls_income_accounts', $incomeAccounts);
    }

    public function getQuickBooksTaxClasses()
    {
        return self::instance()->get_option('ls_qbo_tax_classes');
    }

    public function updateQuickBooksTaxClasses($quickBooksTaxClasses)
    {
        return self::instance()->update_option('ls_qbo_tax_classes', $quickBooksTaxClasses);
    }

    public function getQuickBooksDuplicateProducts()
    {
        return self::instance()->get_option('ls_qbo_duplicate_products');
    }

    public function updateQuickBooksDuplicateProducts($duplicateProducts)
    {
        return self::instance()->update_option('ls_qbo_duplicate_products', $duplicateProducts);
    }

    public function getQuickBooksLocationList()
    {
        return self::instance()->get_option('ls_location_list');
    }

    public function updateQuickBooksLocationList($locationList)
    {
        return self::instance()->update_option('ls_location_list', $locationList);
    }

    public function getQuickBooksClasses()
    {
        return self::instance()->get_option('ls_qbo_classes');
    }

    public function updateQuickBooksClasses($quickBooksClasses)
    {
        return self::instance()->update_option('ls_qbo_classes', $quickBooksClasses);
    }

    public function getQuickBooksPaymentMethods()
    {
        return self::instance()->get_option('ls_qbo_payment_methods');
    }

    public function updateQuickBooksPaymentMethods($paymentMethods)
    {
        return self::instance()->update_option('ls_qbo_payment_methods', $paymentMethods);
    }

    /**
     * Save last update_at value to the database plus one second
     * @param $type
     * @param null $utc_date_time
     * @return bool|mixed|string|void
     */
    public function last_update($type, $utc_date_time = null)
    {
        $types = array('product_last_update', 'order_last_update');
        if (!in_array($type, $types)) {
            return false;
        }

        $last_updated_at = self::instance()->get_option($type);
        if (empty($utc_date_time)) {
            return $last_updated_at;
        }

        $last_time = strtotime($last_updated_at);
        $time_arg = strtotime($utc_date_time);
        if ($last_time < $time_arg) {
            $lt_plus_one_second = date("Y-m-d H:i:s", $time_arg + 1);
            self::instance()->update_option($type, $lt_plus_one_second);
            return $lt_plus_one_second;
        }

        return false;
    }

    /**
     * Get site admin email
     * @return mixed|void
     */
    public function get_current_admin_email()
    {
        return get_option('admin_email');
    }

    /**
     * Uses Wordpress update_option
     * @param $key
     * @param $value
     * @return bool
     */
    public function update_option($key, $value)
    {
        $key = self::instance()->option_prefix . $key;
        return update_option($key, $value);
    }

    /**
     *  Uses Wordpress get_option
     *
     * @param $key
     * @param string $default
     * @return mixed
     */
    public function get_option($key, $default = '')
    {
        $key = self::instance()->option_prefix . $key;
        return get_option($key, $default);
    }

    /**
     * Make constructor private, so nobody can call "new Class".
     */
    private function __construct()
    {
    }

    /**
     * Make clone magic method private, so nobody can clone instance.
     */
    private function __clone()
    {
    }

    /**
     * Make sleep magic method private, so nobody can serialize instance.
     */
    private function __sleep()
    {
    }

    /**
     * Make wakeup magic method private, so nobody can unserialize instance.
     */
    private function __wakeup()
    {
    }

}