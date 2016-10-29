<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
//    'admin/login' => array(
//        array(
//            'field' => 'login',
//            'label' => 'Логин',
//            'rules' => 'trim|required|alpha_dash|min_length[5]|max_length[20]'
//        ),
//        array(
//            'field' => 'password',
//            'label' => 'Пароль',
//            'rules' => 'trim|required|alpha_numeric|min_length[5]|max_length[30]'
//        ),
//
//    ),
//
//    'admin/servers/add' => array(
//        array(
//            'field' => 'url',
//            'label' => 'URL сервера',
//            'rules' => 'trim|required|valid_url'
//        ),
//        array(
//            'field' => 'rating',
//            'label' => 'Рейт',
//            'rules' => 'required|integer|less_than[9999999]'
//        ),
//        array(
//            'field' => 'date',
//            'label' => 'Дата старта',
//            'rules' => 'required'
//        ),
//    ),

    '/admin/users/edit' => array(
        array(
            'field' => 'login',
            'label' => 'логин',
            'rules' => 'trim|required|min_length[5]|max_length[15]'
        ),
        array(
            'field' => 'name',
            'label' => 'имя',
            'rules' => 'trim|max_length[100]'
        ),
        array(
            'field' => 'email',
            'label' => 'e-mail',
            'rules' => 'trim|required|valid_email|is_unique'
        ),
        array(
            'field' => 'password',
            'label' => 'Новый пароль',
            'rules' => 'trim|min_length[8]|max_length[20]'
        ),
        array(
            'field' => 'conf_password',
            'label' => 'Повторить пароль',
            'rules' => 'trim|matches[password]'
        ),
        array(
            'field' => 'group',
            'label' => 'Группа',
            'rules' => 'required|in_list[0,1,2]'
        )
    )
);