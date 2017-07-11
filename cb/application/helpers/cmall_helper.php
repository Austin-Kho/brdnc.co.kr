<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cmall helper
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */


/**
 * 게시물 열람 페이지 주소를 return 합니다
 */
if ( ! function_exists('cmall_item_url')) {
    function cmall_item_url($url = '')
    {
        $url = trim($url, '/');
        $itemurl = site_url(config_item('uri_segment_cmall_item') . '/' . $url);
        return $itemurl;
    }
}

/**
 * 임시 저장된 주문 데이터를 serialize인지 base64_encode 인지 체크하여 배열로 리턴합니다.
 */
if ( ! function_exists('cmall_tmp_replace_data')) {
    function cmall_tmp_replace_data($data)
    {
        $result = is_serialized($data) ? unserialize($data) : unserialize(base64_decode($data));
        return $result;
    }
}

//주문데이터 가져오기
if ( ! function_exists('get_cmall_order_data')) {
    function get_cmall_order_data($order_no)
    {
        $CI = & get_instance();

        $CI->load->model('Cmall_order_model');

        $where = array(
            'cor_id' => $order_no
        );
        $order = $CI->Cmall_order_model->get_one('', '', $where);

        return $order;
    }
}

if ( ! function_exists('exists_inicis_cmall_order')) {

    function exists_inicis_cmall_order($order_no, $pp=array(), $od_time=''){
        
        $CI = & get_instance();

        $CI->session->set_userdata('unique_id', '');
        $CI->session->set_userdata('order_cct_id', '');

        $CI->load->model('Payment_inicis_log_model');
        $CI->Payment_inicis_log_model->delete($oid);        //임시 저장 삭제

        redirect('cmall/orderresult/' . $order_no);

    }

}