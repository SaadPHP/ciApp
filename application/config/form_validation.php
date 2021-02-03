<?php

$config = array(
    'login' => array(
        array(
            'field' => 'username',
            'label' => 'User Name',
            'rules' => 'required|trim|alpha_dash'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|trim'
        )
    ),
    'registration' => array(
        array(
            'field' => 'username',
            'label' => 'User Name',
            'rules' => 'required|trim|alpha_dash'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'firstname',
            'label' => 'First Name',
            'rules' => 'required|trim|alpha'
        ),
        array(
            'field' => 'lastname',
            'label' => 'Last Name',
            'rules' => 'required|trim|alpha'
        ),
        array(
            'field' => 'roles',
            'label' => 'User Role',
            'rules' => 'required'
        ),
    ),
    'add_article' => array(
        array(
            'field' => 'title',
            'label' => 'Add Title',
            'rules' => 'required|trim|alpha_numeric_spaces'
        ),
        array(
            'field' => 'body',
            'label' => 'Details',
            'rules' => 'required|trim|alpha_numeric_spaces'
        )
    )

);

?>

