<?php

$config = array(
    'login' => array(
        array(
            'field' => 'username',
            'label' => 'User Name',
            'rules' => 'required|trim|alpha'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|trim'
        )
    )
);

?>

