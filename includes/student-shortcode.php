<?php
function sm_student_list_shortcode() {
    $args = array(
        'post_type'      => 'sinh_vien',
        'posts_per_page' => -1, 
        'post_status'    => 'publish'
    );

    $students_query = new WP_Query( $args );

    ob_start();

    if ( $students_query->have_posts() ) {
        echo '<table class="student-manager-table">';
        echo '<thead><tr><th>STT</th><th>MSSV</th><th>Họ tên</th><th>Lớp</th><th>Ngày sinh</th></tr></thead>';
        echo '<tbody>';

        $stt = 1;
        while ( $students_query->have_posts() ) {
            $students_query->the_post();
            $post_id = get_the_ID();           
            $mssv = get_post_meta( $post_id, '_sm_mssv', true );
            $lop  = get_post_meta( $post_id, '_sm_lop', true );
            $dob  = get_post_meta( $post_id, '_sm_dob', true );
            $formatted_dob = !empty($dob) ? date('d/m/Y', strtotime($dob)) : '';
            echo '<tr>';
            echo '<td>' . $stt . '</td>';
            echo '<td>' . esc_html( $mssv ) . '</td>';
            echo '<td>' . get_the_title() . '</td>';
            echo '<td>' . esc_html( $lop ) . '</td>';
            echo '<td>' . esc_html( $formatted_dob ) . '</td>';
            echo '</tr>';
            $stt++;
        }

        echo '</tbody></table>';
        wp_reset_postdata();
    } else {
        echo '<p>Chưa có dữ liệu sinh viên.</p>';
    }

    return ob_get_clean();
}
add_shortcode( 'danh_sach_sinh_vien', 'sm_student_list_shortcode' );