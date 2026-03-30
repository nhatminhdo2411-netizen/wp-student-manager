<?php
function sm_register_student_cpt() {
    $labels = array(
        'name'               => 'Sinh viên',
        'singular_name'      => 'Sinh viên',
        'menu_name'          => 'Sinh viên',
        'add_new'            => 'Thêm mới',
        'add_new_item'       => 'Thêm Sinh viên mới',
        'edit_item'          => 'Sửa Sinh viên',
        'all_items'          => 'Tất cả Sinh viên',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-welcome-learn-more',
        'supports'           => array( 'title', 'editor' ),
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'sinh-vien' ),
    );

    register_post_type( 'sinh_vien', $args );
}
add_action( 'init', 'sm_register_student_cpt' );