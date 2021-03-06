<?php

return [

/*------------------------------------------------------------
*                  ADMIN - POLL
*------------------------------------------------------------*/
    'title' => 'Poll',
    'head' => [
        'create' => 'TẠO POLL',
        'index' => 'DANH SÁCH POLL',
        'edit' => 'CHỈNH SỬA POLL',
    ],
    'label' => [
        'step_1' => 'Thông tin',
        'full_name' => 'Tên',
        'email' => 'Địa chỉ email',
        'chatwork' => 'Chatwork ID',
        'title' => 'Tiêu đề',
        'description' => 'Mô tả',
        'location' => 'Vị trí',
        'time_close' => 'Thời gian đóng poll',
        'type' => 'Kiểu poll',
        'created_at' => 'Thời gian tạo poll',
        'status' => 'Trạng thái',
        'single_choice' => 'Một đáp án',
        'multiple_choice' => 'Nhiều đáp án',
        'opening' => 'Mở',
        'closed' => 'Đóng',
        'poll_opening' => '<span class="label label-success">đang mở</span>',
        'poll_closed' => '<span class="label label-danger">đã đóng</span>',
        'step_2' => 'Tùy chọn',
        'option' => 'Tùy chọn',
        'option_image' => 'Ảnh',
        'step_3' => 'Cài đặt',
        'setting' => [
            'required_email' => 'Yêu cầu email để bầu chọn',
            'hide_result' => 'Ẩn kết quả bầu chọn',
            'custom_link' => 'Chỉnh sửa link',
            'set_limit' => 'Đặt số lượng bầu chọn tối đa',
            'set_password' => 'Đặt mật khẩu',
            'show_password' => 'Hiển thị mật khẩu',
            'password_poll' => 'Mật khẩu của poll: ',
            'on' => 'ON',
            'off' => 'OFF',
            'is_set_ip' => 'Mỗi máy chỉ được bầu chọn một lần',
        ],
        'step_4' => 'Người tham gia',
        'invite' => 'Nếu bạn muốn gởi thư mời tham gia bầu chọn đến email cụ thể, hãy nhập vào ô dưới đây',
        'search' => 'Tìm kiếm thông tin poll',
        'search_all' => 'Tất cả',
        'no_data' => 'Không có dữ liệu',
    ],
    'label_for' => [
        'full_name' => 'tên',
        'email' => 'địa chỉ email',
        'chatwork' => 'chatwork',
        'title' => 'tiêu đề',
        'description' => 'mô tả',
        'location' => 'vị trí',
        'time_close' => 'thời gian',
        'type' => 'kiểu',
        'status' => 'trạng thái',
        'opening' => 'đang mở',
        'closed' => 'đã đóng',
        'option' => 'tùy chọn',
        'option_image' => 'ảnh',
        'setting' => [
            'required_email' => 'enter_email',
            'add_answer' => 'add_answer',
            'hide_result' => 'hide_result',
            'custom_link' => 'custom_link',
            'set_limit' => 'enter_limit',
            'set_password' => 'enter_password',
            'show_password' => 'show_password',
            'on' => 'turn_on',
            'off' => 'turn_off',
        ],
        'single_choice' => 'single',
        'multiple_choice' => 'multiple',
        'invite' => 'invite',
    ],
    'placeholder' => [
        'full_name' => 'Nhập tên bạn...',
        'email' => 'Nhập địa chỉ email của bạn...',
        'chatwork' => 'Nhập chatwork id của bạn...',
        'title' => 'Nhập tiêu đề của poll...',
        'description' => 'Nhập mô tả cho poll này...',
        'time_close' => 'Chọn thời gian để đóng poll này...',
        'location' => 'Nhập vị trí...',
        'number_add' => 'Nhập số lượng cần thêm vào...',
        'number_limit' => 'Số lượng',
        'password_poll' => 'Nhập mật khẩu của poll...',
        'option' => 'Nhập tùy chọn của poll...',
        'email_participant' => 'Nhập email người tham gia...',
        'comment' => 'Nhập nội dung bình luận...',
        'enter_name' => 'Nhập tên của bạn...',
        'token_link' => 'Vui lòng nhập token...',
    ],
    'button' => [
        'search_poll' => 'TÌM KIẾM',
        'reset_search' => 'Reset kết quả',
        'create_poll' => 'TẠO POLL',
        'change_poll_infor' => 'THAY ĐỔI THÔNG TIN',
        'change_poll_option' => 'THAY ĐỔI TÙY CHỌN',
        'change_poll_setting' => 'THAY ĐỔI CÀI ĐẶT',
        'back' => 'QUAY LẠI DANH SÁCH POLL',
        'remove' => 'Xóa',
        'save_info' => 'Lưu thông tin',
        'save_option' => 'Lưu tùy chọn',
        'save_setting' => 'Lưu cài đặt',
        'continue' => 'Tiếp tục',
        'previous' => 'Trước',
        'finish' => 'Kết thúc',
        'administration' => 'QUẢN LÝ POLL',
        'edit_back' => 'Quay lại',
    ],
    'message' => [
        'create_success' => 'Tạo Poll THÀNH CÔNG',
        'create_fail' => 'Tạo Poll THẤT BẠI',
        'upload_image_fail' => 'Không thể cập nhật ảnh cho tùy chọn',
        'send_mail_fail' => 'Không thể gửi email mời người khác',
        'confirm_delete' => 'Bạn có chắc chắn muốn xóa poll này không?',
        'confirm_delete_option' => 'Bạn có chắc chắc muốn xóa option này không. Nó sẽ xóa tất cả các vote của option?',
        'link_exists' => 'Link đã tồn tại trong hệ thống, vui lòng chọn link mới',
        'link_valid' => 'Bạn có thể sử dụng poll này',
        'submit_form' => 'Lưu thành công',
        'not_found_polls' => 'Không tìm thất poll trong hệ thống',
        'update_poll_info_success' => 'Cập nhật thông tin Poll THÀNH CÔNG',
        'update_poll_info_fail' => 'Cập nhật thông tin poll THẤT BẠI',
        'update_option_success' => 'Cập nhật tùy chọn THÀNH CÔNG',
        'update_option_fail' => 'Cập nhạt tùy chọn THẤT BẠI',
        'update_setting_success' => 'Cập nhật cài đặt Poll THÀNH CÔNG',
        'update_setting_fail' => 'Cập nhật cài đặt Poll THẤT BẠI',
        'delete_poll_fail' => 'Xóa Poll THẤT BẠI',
        'delete_poll_success' => 'Xóa poll THÀNH CÔNG',
        'email_exists' => 'Địa chỉ email đã tồn tại trong hệ thống, vui lòng chọn địa chỉ email khác hoặc đăng nhập',
        'email_valid' => 'Địa chỉ email hợp lệ, bạn có thể sử dụng email này',
        'no_setting' => 'Không có bất kỳ cài đặt nào được thiết lập cho poll này',
        'no_poll_create' => 'Bạn chưa tạo poll nào.',
        'no_poll_participant' => 'Bạn chưa tham gia poll nào.',
        'no_poll_close' => 'Bạn chưa đóng poll nào.',
    ],
    'validation' => [
        'name' => [
            'required' => 'Vui lòng nhập tên của bạn!',
            'max' => 'Tên có tối đa' . config('settings.length_poll.name') . ' ký tự',
        ],
        'email' => [
            'required' => 'Vui lòng nhập địa chỉ email của bạn!',
            'max' => 'Địa chỉ email tối đa' . config('settings.length_poll.email') . ' ký tự',
            'email' => 'Email invalid!'
        ],
        'title' => [
            'required' => 'Vui lòng nhập tiêu đề poll!',
            'max' => 'Tiêu đề có tối đa' . config('settings.length_poll.title') . ' ký tự',
        ],
        'description' => [
            'max' => 'Mô tả có tối đa' . config('settings.length_poll.description') . ' ký tự',
        ],
        'type' => [
            'required' => 'Vui lòng chọn kiểu của poll',
        ],
        'option' => [
            'option' => 'Vui lòng nhập một tùy chọn cho poll',
        ],
        'setting' => [
            'setting' => 'Cài đặt không chính xác, vui lòng thử lại!',
        ],
        'participant' => [
            'email' => 'VUi lòng nhập địa chỉ email của người tham gia',
        ],
    ],
    'table' => [
        'thead' => [
            'STT' => 'Số thứ tự.',
            'creator' => 'Người tạo',
            'title' => 'Tiêu đề',
            'status' => 'Trạng thái',
            'type' => 'Loại',
            'link' => 'Liên kết',
            'created_at' => 'Ngày tạo',
        ],
        'tbody' => [
            'name' => 'Tên: ',
            'email' => 'Email: ',
             'link_administration' => 'Quản lý: ',
            'link_participant' => 'Tham gia: ',
        ],
    ],
    'tooltip' => [
        'edit' => 'Chỉnh sửa poll này',
        'duplicate' => 'Tạo bản sao của poll',
        'delete_comment' => 'Xóa tất cả bình luận',
        'delete' => 'Xóa poll này',
        'show' => 'Xem chi tiết poll này',
        'open' => 'Mở poll này',
        'close' => 'Đóng poll này',
        'info' => '<p>Bạn cần cung cấp thông tin poll</p>
                            <p>
                                Thông tin cần phải nhập
                                <ul>
                                    <li><b>Tên và email</b> để xác định người tạo bình chọn</li>
                                    <li><b>Tiêu đề</b> để xác định tiêu đề bình chọn</li>
                                    <li><b>Kiểu bình chọn</b> để xác định loại bình chọn: 1 câu trả lời hay nhiều câu trả lời</li>
                                </ul>
                            </p>
                            <p>
                                Thông tin thêm(có thể nhập hoặc không)
                                <ul>
                                    <li><b>Mô tả</b> để cung cấp thêm thông tin cho bình chọn</li>
                                    <li><b>Thời gian đóng bình chọn</b> để tự động đóng bình chọn theo thời gian cụ thể</li>
                                    <li><b>Vị trí</b> để cung cấp thêm vị trí cho bình chọn</li>
                                </ul>
                            </p>',
        'option' => '<p>Bạn cần nhập các câu trả lời để bình chọn</p>
                            <p>*Lưu ý:
                                <ul>
                                    <li>Tối thiểu là một câu trả lời</li>
                                    <li>Câu trả lời phải có nội dung</li>
                                    <li>Câu trả lời không được trùng nhau</li>
                                    <li>Câu trả lời có thể có hình ảnh</li>
                                </ul>
                            </p>',
        'setting' => '<p>Cài đặt của bình chọn(Bạn có thể bỏ qua bước này)</p>
                            <ul>
                               <li><b>Yêu cầu email để bầu chọn</b></li> Muốn bầu chọn thì người tham gia phải nhập email
                                <li><b>Ẩn kết quả bầu chọn</b></li> Người tham gia bầu chọn không thấy được kết quả của bình chọn đó.
                                <li><b>Chỉnh sửa link</b></li> Nhằm giúp link bầu chọn dễ nhớ hơn.
                                <li><b>Đặt số lượng bầu chọn tối đa</b></li> Bầu chọn sẽ kết thúc khi số lượng bầu chọn đạt đến số lượng được cài đặt
                                <li><b>Đặt mật khẩu</b></li> Người tham gia bầu chọn phải nhập mật khẩu để bầu chọn
                                <li><b>Chỉ được bầu chọn một lần</b></li> Nếu bật thì mỗi người bầu chọn một lần, nếu tắt thì một người được bầu chọn nhiều lần
                            </ul>',
        'participant' => '<p>Người tham gia bình chọn(Bạn có thể bỏ qua bước này)</p>
                            <p>Nếu bạn muốn gời mail mời các người tham gia cụ thể, thì hãy nhập email của họ vào ô bên dưới</p>
                            <p>*Lưu ý
                                <ul>
                                    <li>Khi nhập xong một email hãy nhấn ENTER để xác nhận</li>
                                </ul>
                            </p>',
    ],
    'nav_tab_edit' => [
        'info' => 'THÔNG TIN',
        'option' => 'TÙY CHỌN',
        'setting' => 'CÀI ĐẶT',
        'voting' => 'BÌNH CHỌN',
        'result' => 'KẾT QUẢ',
    ],
    'message_client' => [
        'required' => 'Vui lòng nhập vào ô này',
        'max' => 'Vui lòng nhập giá trị nhỏ hơn hoặc bằng ',
        'email' => 'Địa chỉ email chưa chính xác!',
        'number' => 'Giá trị phải là số!',
        'choose' => 'Vui lòng chọn ',
        'option_empty' => 'Bạn phải thêm một tùy chọn mới',
        'option_required' => 'Bạn phải nhập nội dung của tùy chọn',
        'participant_empty' => 'Bạn phải thêm một địa chỉ email',
        'character' => ' kí tự',
        'email_exist' => 'Địa chỉ email không tồn tại, vui lòng thử lại!',
        'time_close_poll' => 'Thời gian đóng poll phải lớn hơn thời gian hiện tại',
        'on' => 'BẬT',
        'off' => 'TẮT',
        'link_exists' => 'Đường dẫn này đã tồn tại trong hệ thống, vui lòng thử lại!',
        'link_valid' => 'Đường dẫn hợp lệ, bạn có thể dùng đường dẫn này',
        'confirm_delete_option' => 'Bạn có chắc chắc muốn xóa option này không. Nó sẽ xóa tất cả các vote của option?',
        'email_exist_database' => '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Email đã tồn tại trong hệ thống, bạn nên đăng nhập để tạo bình chọn',
        'send_email_success' => 'Một email đã được gởi đến hộp thư của bạn, Vui lòng vào mail để kiểm tra lại.',
        'send_email_fail' => 'Gởi mail thất bại, vui lòng kiểm tra lại địa chỉ email của bạn',
        'option_duplicate' => 'Tên tùy chọn đã bị trùng, hãy nhập một tên mới...',
        'option_minimum' => 'Bạn không thể xóa tùy chọn này vì bình chọn phải có ít nhất một câu trả lời',
        'option_image_duplicate' => 'Có hai hình ảnh giống nhau, bạn chắc chắn sử dụng nó?',
        'number_edit' => 'Số lượng bầu chọn tối đa phải lớn hơn tổng số lượt bình chọn, tổng số lượt bình chọn hiện tại là ',
        'image' => 'Hình ảnh không hợp lệ, vui lòng kiểm tra lại',
    ],
    'mail' => [
        'label' => [
            'introduction' => 'GIỚI THIỆU',
        ],
        'introduction' => 'Chúng tôi sẽ giúp bạn tạo một poll một cách dễ dàng và nhanh chóng. Hãy truy cập vào <a href="' . url("/") .'">' .url("/") . '</a>',
        'participant' => [
            'head' => 'POLL - VOTING',
            'link' => 'Link để vote: ',
        ],
    ],
       'result_create' => [
       'head' => 'Fpoll',
         'thank' => 'Cảm ơn, ',
         'create_success' => 'Poll của bạn đã được tạo thành công',
         'send_mail' => 'Dưới đây là 2 link được gởi đến email :email',
        'participant_link' => 'Link để mời',
        'help_participant' => 'Gởi link này đến bất kỳ ai bạn muốn mời họ tham gia bình chọn',
         'link_admin' => 'Link quản lý',
         'help_admin' => 'Truy cập vào link này để thay đổi, đóng hoặc xóa poll',
     ],

/*------------------------------------------------------------
*                  USER - POLL
*------------------------------------------------------------*/
    'poll' => 'Poll',
    'vote' => 'Bầu chọn',
    'vote_page' => 'Trang bầu chọn',
    'close' => 'Đóng',
    'name' => 'Tên',
    'email' => 'Email',
    'no' => 'STT',
    'poll_history' => 'Lịch sử poll',
    'show_vote_details' => 'Xem chi tiết bầu chọn',
    'poll_info' => 'Thông tin',
    'activity_poll' => 'Hoạt động',
    'next' => 'Tiếp',
    'optional' => 'Không bắt buộc',
    'one_answer' => 'Một câu trả lời',
    'multiple_answer' => 'Nhiều câu trả lời',

    'poll_details' => 'Chi tiết poll',
    'poll_initiate' => 'Poll được tạo bởi',
    'where' => 'Địa điểm: ',
    'description' => 'Không có mô tả nào cho Poll này.',
    'location' => 'Không có địa điểm cho poll này',
    'comments' => 'Bình luận',
    'add_comment' => 'Thêm bình luận',
    'show_comments' => 'Xem các bình luận',
    'hide' => 'Ẩn',
    'save_comment' => 'Lưu bình luận',
    'view_history' => 'Xem lịch sử',
    'delete_all_participants' => 'Xóa bầu chọn',
    'list_polls' => 'Danh sách các poll',
    'polls_initiated' => 'Poll đã tạo',
    'subject' => 'Chủ đề',
    'participants' => 'Người bầu chọn',
    'latest_activity' => 'Hoạt động mới nhất',
    'polls_participated_in' => 'Những poll đã tham gia bầu chọn',
    'polls_closed' => 'Những poll đã đóng',
    'list_all_polls' => 'Danh sách poll',
    'administer' => 'Quản trị',
    'close_poll' => 'Đóng poll này',
    'reopen_poll' => 'Mở lại poll',
    'confirm_close_poll' => 'Bạn có muốn đóng poll này không',
    'close_poll_successfully' => 'Bạn đã đóng poll thành công',
    'close_poll_fail' => 'Đóng poll lỗi',
    'reopen_poll_fail' => 'Mở lại poll thất bại',
    'reopen_poll_successfully' => 'Mở lại poll thành công',
    'poll_not_found' => 'Poll không tìm thấy',
    'message_name' => 'Vui lòng nhập tên của bạn',
    'message_email' => 'Vui lòng nhập email của bạn',
    'message_validate_email' => 'Vui lòng nhập email hợp lệ',
    'voted_poll' => 'Bạn đã vote poll này thành công',
    'message_poll_limit' => 'Xin lỗi, bạn không thể xem poll này, poll đã bầu chọn đủ số lượng',
    'message_poll_closed' => 'Xin lỗi, poll đã đóng, bạn không thể xem poll này',
    'comment_name' => 'Vui lòng nhập tên của bạn',
    'comment_content' => 'Vui lòng nhập bình luận',
    'confirmRemove' => 'Bạn có chắc không?',
    'load_latest_polls' => 'Đã cập nhật danh sách poll mới nhất',
    'edit_link_admin' => 'Chỉnh sửa link admin',
    'edit_link_user' => 'Chỉnh sửa link user',
    'participation_link' => 'Link bầu chọn',
    'administer_link' => 'Link quản lý',
    'administration' => 'Quản lý',
    'vote_empty' => 'Hiện tại không có bầu chọn nào',
    'confirm_delete_vote' => 'Bạn có muốn xóa bầu chọn này không?',
    'email_exist' => 'Email này đã tồn tại, bạn cần đăng nhập với email này hoặc nhập một email khác  ',
    'remove_vote_successfully' => 'Bạn đã xóa bầu chọn thành công',
    'vote_successfully' => 'Bạn đã bầu chọn thành công',
    'export_pdf' => 'Xuất file PDF',
    'export_excel' => 'Xuất file EXCEL',
    'link_exist' => 'Link này đã tồn tại',
    'link_invalid' => 'Link không đúng',
    'edit_link_successfully' => 'Sửa thành công',
    'delete_all_participants_successfully' => 'Xóa tất cả những người bầu chọn thành công',
    'incorrect_password' => 'Mật khẩu chưa chính xác',
    'enter_password' => 'Vui lòng nhập mật khẩu để xem poll này',
    'create_duplicate_poll' => 'Tạo poll từ poll này',
    'not_activity' => 'Không có hoạt động nào',
    'confirm_delete_all_participant' => 'Bạn có chắc chắn muốn xóa tất cả các bầu chọn của poll này không?',
    'login_here' => ' Đăng nhập',
    'option' => [
        'name_vote' => 'Tên option',
        'rate_vote' => 'Tỉ lệ phần trăm',
        'count_vote' => 'Số lượng bầu chọn',
    ],
    'hide_result_message' => 'Poll này đã ẩn kết quả bầu chọn.',
    'flashy_message' => 'Mail đã gửi, Vui lòng kiểm tra mail',
    'message_exist_email' => 'Địa chỉ email này không tồn tại',
    'link_vote' => 'Link bầu chọn',
    'link_admin' => 'Link quản lý',
    'email_not_exist' => 'Email tạo poll này không tồn tại',
    'register_with_mail_not_exist' => 'Đăng ký không thành công, Địa chỉ email đăng ký không tồn tại',
    'link_not_found' => 'Xin lỗi, Không tìm thấy đường dẫn này',
    'date_last_vote' => 'Thời gian bình chọn cuối cùng',
    'number_vote' => 'Số lượng',
    'email_voted' => 'Địa chỉ email này đã bầu chọn poll này rồi',
    'check' => 'Kiểm tra',
    'message_required_email' => 'Vui lòng nhập địa chỉ emai để bầu chọn poll này',
    'no_name' => 'Ẩn danh',
    'reach_limit' => 'Poll đã đủ số lượt bầu chọn',
    'action' => 'Xem trang quản trị',
    'required' => 'bắt buộc',
    'image_preview' => 'Xem ảnh chi tiết',
    'table_result' => 'BẢNG KẾT QUẢ',
    'bar_chart' => 'BIỂU ĐỒ HÌNH CỘT',
    'pie_chart' => 'BIỂU ĐỒ HÌNH TRÒN',
    'statistic' => 'THỐNG KÊ',
    'copy_link' => 'Copy link',
    'send_mail_again' => 'Nếu bạn chưa nhận được email, hãy kích vào đây...',
    'total_vote' => 'Tổng lượt bầu chọn',
    'vote_first_time' => 'Thời gian bầu chọn đầu tiên',
    'vote_last_time' => 'Thời gian bầu chọn cuối cùng',
    'option_highest_vote' => 'Option có lượt bầu chọn cao nhất',
    'option_lowest_vote' => 'Option có lượt bầu chọn thấp nhất',
    'message_vote_one_time' => 'Bạn đã bầu chọn poll này, Poll này chỉ được bầu chọn một lần',
    'confirm_reopen_poll' => 'Bạn có muốn mở lại poll này không?',
    'close_date' => 'thời gian đóng poll',
    'show_result' => 'Kết quả',
    'view_option' => 'Xem tùy chọn',
    'view_setting' => 'Xem cài đặt',
];
