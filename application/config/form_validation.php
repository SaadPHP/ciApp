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
    )

);

?>

