<?php
/**
 * Created by PhpStorm.
 * User: gmorgas
 * Date: 17.02.17
 * Time: 17:39
 */

return [
    'custom' => [
        'email' => [
          'required' => 'Pole adresu email jest wymagane.',
          'email'    => 'Zły format adresu email.',
        ],
        'subject' => [
            'required' => 'Pole tematu jest wymagne.',
            'min'    => 'Temat musi być dłuższy niż 3 znaki.',
        ],
        'message' => [
            'required' => 'Pole wiadomości jest wymagane.',
            'min'   => 'Wiadomość musi być dłuższa niż 10 znaków.'
        ],
        'name' => [
            'required' => 'Pole nicku jest wymagane',

        ],
        'comment' => [
            'required' => 'Pole komentarzu jest wymagane',
            'min' => 'Komentarz musi być dłuższy niż 5 znaków',
            'max' => 'Komentarz nie może być dłuższy niż 5 000 znaków',
        ],
    ],
];