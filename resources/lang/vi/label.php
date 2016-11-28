<?php

return [
    'login' => 'Đăng nhập',
    'logout' => 'Đăng xuất',
    'register' => 'Đăng ký',
    'create_poll' => 'Tạo poll',
    'forgot_password' => 'Quên mật khẩu?',
    'remember' => 'Nhớ mật khẩu',
    'email' => 'Địa chỉ email',
    'password' => 'Mật khẩu',
    'avatar' => 'Ảnh đại diện',
    'confirm_password' => 'Nhập lại mật khẩu',
    'name' => 'Tên',
    'label_gender' => 'Giới tính',
    'male' => 'Nam',
    'female' => 'Nữ',
    'profile' => 'Thông tin cá nhân',
    'edit' => 'Chỉnh sửa',
    'home' => 'Trang chủ',
    'admin_page' => 'TRANG CHỦ ADMIN',
    'errors' => 'Thông tin',

    /**
     * MASTER ADMIN
     */
    'placeholder_search' => 'BẮT ĐẦU NHẬP...',
    'name_admin_page' => 'QUẢN LÝ BẦU CHỌN',
    'main_menu' => 'MANU CHÍNH',
    'nav_menu' => [
        'user' => 'User',
        'poll' => 'Poll',
    ],

    /**
     * EMAIL
     */
    'mail' => [
        'head' => 'Fpoll',
        'link_vote' => 'Link bầu chọn vote:',
        'link_admin' => 'Link quản lý vote:',
        'subject' => 'Bầu chọn',
        'delete_all_participant' => 'Quản trị poll này đã xóa tất cả các bầu chọn của poll',
        'register_active_mail' => 'Bạn đã đăng ký thành công, hãy kích vào đường dẫn sau để kích hoạt tài khoản.',
        'edit_poll' => [
            'head' => 'Bầu chọn',
            'summary' => 'Poll của bạn đã được thay đổi.',
            'thead' => [
                'STT' => 'SỐ THỨ TỰ',
                'info' => 'THÔNG TIN',
                'old_data' => 'DỮ LIỆU CŨ',
                'new_data' => 'DỮ LIỆU MỚI',
                'date' => 'NGÀY',
            ],
        ],
        'create_poll' => [
            'title' => 'Bình chọn',
            'head' => 'Fpoll',
            'dear' => 'Thân gởi ',
            'thank' => 'Cảm ơn bạn đã sử dụng trang web của chúng tôi. <br> Bình chọn của bạn đã được tạo thành công. Dưới đây là 2 liên kết được gởi đến tin nhắn của bạn',
            'link_vote' => 'Link để bầu chọn',
            'description_link_vote' => 'Gởi link này đến những người mà bạn muốn mời họ tham gia bầu chọn.',
            'link_admin' => 'Link này để quản lý bình chọn',
            'description_link_admin' => 'Truy cập link này để thay đổi, đóng hoặc xóa bình chọn của bạn.',
            'password' => 'Mật khẩu',
            'note' => '*<u>Lưu ý</u>: Bạn có thể đăng nhập vào trang web của chúng tôi mà không phải đăng ký một tài khoản mới, hãy kích vào "Kích hoạt tài khoản" để mở tài khoản của bạn',
            'active_account' => 'Kích hoạt tài khoản',
            'end' => '-- Kết thúc --',
        ],
        'participant_vote' => [
            'invite' => 'Bạn đã được mời tham gia bình chọn này, hãy kích vào đường dẫn dưới đây để tham gia bầu chọn',
        ],
        'edit_option' => [
            'old_option' => 'TÙY CHỌN CŨ',
            'new_option' => 'TÙY CHỌN MỚI',
            'thank' => 'Cảm ơn bạn đã sử dụng website của chúng tôi',
            'title' => 'Thay đổi tùy chọn',
        ],
        'edit_setting' => [
            'old_setting' => 'CÀI ĐẶT CŨ',
            'new_setting' => 'CÀI ĐẶT MỚI',
            'title' => 'Thay đổi cài đặt',
        ],
        'register' => [
            'thank' => 'Cảm ơn bạn đã sử dụng Website của chúng tôi. <br> Bạn đã đăng ký tài khoản THÀNH CÔNG. Bên dưới là link để kích hoạt tài khoản',
            'link_active' => 'Click vào link bên dưới để kích hoạt tài khoản',
        ],
        'edit_link' => [
            'thank' => 'Cảm ơn bạn đã sử dụng Website của chúng tôi. <br> Bạn đã chỉnh sửa link THÀNH CÔNG.',
            'link_edit' => 'Click vào đường dẫn bên dưới để xem chi tiết',
        ],
        'close_poll' => [
            'thank' => 'Cảm ơn bạn đã sử dụng website của chúng tôi. <br> Bạn đã đóng poll THÀNH CÔNG.',
            'link_admin' => 'Click vào đường dẫn bên dưới để quản lý poll',
        ],
        'open_poll' => [
            'thank' => 'Cảm ơn bạn đã sử dụng website của chúng tôi. <br> Bạn đã mở poll THÀNH CÔNG.',
            'link_admin' => 'Click vào đường dẫn bên dưới để quản lý poll',
        ],
        'delete_participant' => [
            'thank' => 'Cảm ơn bạn đã sử dụng website của chúng tôi. <br> Bạn đã xóa tất cả bầu chọn THÀNH CÔNG.',
            'link_admin' => 'Click vào đường dẫn bên dưới để quản lý poll',
        ],
    ],
    'paginations' => 'Hiển thị :start đến :finish của :numberOfRecords mục|Đang hiển thị :start đến :finish of :numberOfRecords mục',
    'gender' => [
        '' => '',
        '0' => 'Nữ',
        '1' => 'Nam',
        '2' => 'Giới tính khác',
    ],
    'footer' => [
        'location' => 'Tầng 13, Keangnam Landmark 72, Đường Phạm Hùng, Nam Từ Liêm, Hà Nội, Việt Nam',
        'copyright' => 'Copyright 2016 Framgia',
        'email' => 'hr_team@framgia.com',
        'phone' => ' 84-4-3795-5417',
        'about' => 'Giới thiệu website',
        'description_website' => 'Website giúp bạn tạo một bầu chọn nhanh chóng và dễ dàng',
        'facebook' => 'https://www.facebook.com/FramgiaVietnam',
        'github' => 'https://github.com/framgia',
        'linkedin' => 'https://www.linkedin.com/company/framgia-vietnam',
    ],

    /*
     * home page
     */
    'feature' => [
        'name' => 'TÍNH NĂNG',
        'vote' => 'Tạo bình chọn nhanh chóng và dễ dàng',
        'chart' => 'Minh họa kết quả qua các biểu đồ',
        'security' => 'Đảm bảo tính bảo mật thông qua mật khẩu bình chọn',
        'export' => 'Truy xuất kết quả dưới dạng PDF, EXCEL',
        'share' => 'Chia sẻ bình chọn thông qua Facebook',
        'responsive' => 'Truy cập mọi lúc mọi nơi và hỗ trợ trên nhiều loại thiết bị',
    ],
    'top' => 'Đầu trang',
    'tutorial' => 'Hướng dẫn',
];
