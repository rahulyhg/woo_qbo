<?php if ( ! defined( 'ABSPATH' ) ) exit('Access is Denied');

class LS_Json_Product_Factory{

	private $json_product = null;

	/**
	 * For updating product id should be set
	 * @param $id
	 */
	public function set_id( $id ){
		$this->set( 'id', $id );
	}

	/**
	 * Set the value of name
	 * @param $name
	 */
	public function set_name( $name ){
		$this->set('name', $name );
	}

	/**
	 * Set the value of description
	 * @param $description
	 */
	public function set_description( $description ){
		$this->set( 'description', $description );
	}

	/**
	 * Set the value of list_price
	 * @param $list_price
	 */
	public function set_list_price( $list_price ){
		$this->set( 'list_price', $list_price );
	}

	/**
	 * Set the value of sell_price
	 * @param $sell_price
	 */
	public function set_sell_price( $sell_price ){
		$this->set( 'sell_price', $sell_price );
	}

	/**
	 * Set tax_value key in sending json string to lws
	 * @param $tax_value
	 */
	public function set_tax_value($tax_value){
		$this->set('tax_value', $tax_value);
	}

	/**
	 * Set tax_name key in sending json string to lws
	 * @param $tax_name
	 */
	public function set_tax_name($tax_name){
		$this->set('tax_name', $tax_name);
	}

	/**
	 * Set tax_rate key in sending json string to lws
	 * @param $tax_rate
	 */
	public function set_tax_rate($tax_rate){
		$this->set('tax_rate', $tax_rate);
	}

	/**
	 * Set tax_id key in sending json string to lws
	 * @param $tax_id
	 */
	public function set_tax_id($tax_id){
		$this->set('tax_id', $tax_id);
	}


	/**
	 * Set the value of quantity
	 * @param $quantity
	 */
	public function set_quantity( $quantity ){
		$this->set( 'quantity', $quantity );
	}

	/**
	 * Set the value of product_type
	 * @param $product_type
	 */
	public function set_product_type( $product_type ){
		$this->set( 'product_type', $product_type );
	}

	public function get_product_type(){
		return $this->get('product_type');
	}

	/**
	 * Set the value of sku
	 * @param $sku
	 */
	public function set_sku( $sku ){
		$this->set( 'sku', $sku );
	}

	/**
	 * Set the value of active
	 * @param $active
	 */
	public function set_active( $active ){
		$this->set( 'active', $active );
	}

	/**
	 * Set the value of income_account_id
	 * @param $income_account_id
	 */
	public function set_income_account_id( $income_account_id ){
		$this->set( 'income_account_id', $income_account_id );
	}

	/**
	 * Set the value of expense_account_id
	 * @param $expense_account_id
	 */
	public function set_expense_account_id( $expense_account_id ){
		$this->set( 'expense_account_id', $expense_account_id );
	}

	/**
	 * Set the value of asset_account_id
	 * @param $asset_account_id
	 */
	public function set_asset_account_id( $asset_account_id ){
		$this->set( 'asset_account_id', $asset_account_id );
	}

	public function set_includes_tax( $includes_tax ){
		$this->set( 'includes_tax', $includes_tax );
	}

	/**
	 * Set each product attributes like name, description ,sku etc
	 * @param $key
	 * @param $value
	 */
	public function set( $key, $value ){
		if( !empty($key) ){
			$this->json_product[$key] = $value;
		}
	}

	/**
	 * Returns the attribute being set to the whole class/object
	 *
	 * @param $key
	 *
	 * @return null
	 */
	public function get( $key ){
		if(empty($key)){
			return null;
		}

		if(!isset($this->json_product[$key])){
			return null;
		}

		return $this->json_product[$key];
	}

	/**
	 * Returns a json representation of a single product for LWS
	 * @return string
	 */
	public function get_json_product(){
		return json_encode($this->json_product);
	}

}