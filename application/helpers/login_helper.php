<?php

function logged_in()

{
    $instan = get_instance();
    if (!$instan->session->userdata('email')) {

        $instan->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissible fade show" role="alert"> <strong>Email is empety !</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('auth');
    } else {
        $role_id = $instan->session->userdata('role_id');
        $status = $instan->uri->segment(1);
        $queriMenu = $instan->db->get_where('user_menu', ['menu' => $status])->row_array();
        $menu_id = $queriMenu['id'];
        $userAccess = $instan->db->get_where('user_access_menu', [
            'menu_id' => $menu_id,
            'role_id' => $role_id
        ]);
        if ($userAccess->num_rows() < 1) {
            $instan->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissible fade show" role="alert"> <strong>url empety !</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('auth/block');
        }
    }
}
