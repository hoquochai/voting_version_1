<?php

return [
    'number_of_record_user' => 10,
    'length_user' => [
        'name' => 255,
        'email' => 255,
        'chatwork' => 255,
        'password' => 16,
        'avatar'=> 10000,
    ],
    'avatar_path' => 'uploads/avatar',
    'avatar_default' => 'default.jpg',
    'gender' => [
        '0' => 'Female',
        '1' => 'Male',
        '2' => 'Other',
    ],
    'gender_constant' => [
        '' => 3,
        'male' => 1,
        'female' => 0,
        'other' => 2,
    ],
    'activity' => [
        'participated' => '1',
        'all_participants_deleted' => '2',
        'added_a_comment' => '3',
        'reset_link' => '4',
        'delete_comment' => '5',
        'edit_vote' => '6',
    ],
    'image_default_path' => 'uploads/avatar/default.jpg',
    'user' => [
        'register' => 1,
        'create_poll' => 0,
    ],

    /**-------------------------------
     * Poll config
    -------------------------------*/
    'str_limit' => [
        'location' => 20,
    ],
    'length_poll' => [
        'name' => 255,
        'email' => 255,
        'title' => 255,
        'description' => 255,
        'link' => 16,
        'option' => 3,
        'number_record' => 10,
        'number_option' => 1,
        'number_limit' => 2,
        'password_poll' => 16,
    ],
    'type_poll' => [
        'single_choice' => 0,
        'multiple_choice' => 1,
    ],
    'status' => [
        'open' => 1,
        'close' => 0,
    ],
    'option' => [
        'path_image' => '/uploads/options/',
        'path_image_default' => '/uploads/images/default-thumb.gif',
    ],
    'setting' => [
        'required_email' => 1,
        'hide_result' => 2,
        'custom_link' => 3,
        'set_limit' => 4,
        'set_password' => 5,
        'is_set_ip' => 6,
    ],
    'participant' => [
        'invite_all' => 0,
        'invite_people' => 1,
    ],
    'email' => [
        'link_vote' => '/link/',
    ],
    'link_poll' => [
        'vote' => 0,
        'admin' => 1,
    ],
    'search_all' => 3,
    'view' => [
        'poll_mail' => 'layouts.poll_mail',
        'participant_mail' => 'layouts.participant_mail',
        'mail_edit_option' => 'layouts.mail_edit_option',
        'mail_edit_setting' => 'layouts.mail_edit_setting'
    ],
    'type' => [
        'user' => 'user',
        'participant' => 'participant',
    ],
    'date_format' => 'h:i:s A d/m/Y',
    'language' => [
        'en' => 'English',
        'vi' => 'Tiếng Việt',
        'ja' => '日本語',
    ],
    'locale' => ['vi', 'en', 'ja'],
    'default_value' => 0,
    'limit_link' => 60,
    'limit_name' => 80,
    /* vote */
    'no_name' => 'Ẩn danh',
];
