<?php
function sm_add_student_metabox() {
    add_meta_box(
        'sm_student_info_box',
        'Thông tin chi tiết Sinh viên',
        'sm_render_student_metabox',
        'sinh_vien',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'sm_add_student_metabox' );
function sm_render_student_metabox( $post ) {
    wp_nonce_field( 'sm_save_student_data', 'sm_student_nonce' );
    $mssv = get_post_meta( $post->ID, '_sm_mssv', true );
    $lop  = get_post_meta( $post->ID, '_sm_lop', true );
    $dob  = get_post_meta( $post->ID, '_sm_dob', true );

    ?>
    <p>
        <label for="sm_mssv"><strong>Mã số sinh viên (MSSV):</strong></label><br>
        <input type="text" id="sm_mssv" name="sm_mssv" value="<?php echo esc_attr( $mssv ); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="sm_lop"><strong>Lớp/Chuyên ngành:</strong></label><br>
        <select id="sm_lop" name="sm_lop" style="width:100%;">
            <option value="CNTT" <?php selected( $lop, 'CNTT' ); ?>>CNTT</option>
            <option value="Kinh tế" <?php selected( $lop, 'Kinh tế' ); ?>>Kinh tế</option>
            <option value="Marketing" <?php selected( $lop, 'Marketing' ); ?>>Marketing</option>
        </select>
    </p>
    <p>
        <label for="sm_dob"><strong>Ngày sinh:</strong></label><br>
        <input type="date" id="sm_dob" name="sm_dob" value="<?php echo esc_attr( $dob ); ?>" style="width:100%;" />
    </p>
    <?php
}
function sm_save_student_data( $post_id ) {
    if ( ! isset( $_POST['sm_student_nonce'] ) || ! wp_verify_nonce( $_POST['sm_student_nonce'], 'sm_save_student_data' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['sm_mssv'] ) ) {
        update_post_meta( $post_id, '_sm_mssv', sanitize_text_field( $_POST['sm_mssv'] ) );
    }
    if ( isset( $_POST['sm_lop'] ) ) {
        update_post_meta( $post_id, '_sm_lop', sanitize_text_field( $_POST['sm_lop'] ) );
    }
    if ( isset( $_POST['sm_dob'] ) ) {
        update_post_meta( $post_id, '_sm_dob', sanitize_text_field( $_POST['sm_dob'] ) );
    }
}
add_action( 'save_post_sinh_vien', 'sm_save_student_data' );