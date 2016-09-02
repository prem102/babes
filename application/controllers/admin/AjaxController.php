<?php
/**
 * @package    CI
 * @subpackage Controller
 * @author     Jeevan<jeevan@tisindiasupport.com>
 * @description  Handle all type of ajax requerst with response.
 */
Class AjaxController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/Product_model');
    }
}
