<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'name'                       => 'Name',
            'name_helper'                => ' ',
            'email'                      => 'Email',
            'email_helper'               => ' ',
            'email_verified_at'          => 'Email verified at',
            'email_verified_at_helper'   => ' ',
            'password'                   => 'Password',
            'password_helper'            => ' ',
            'roles'                      => 'Roles',
            'roles_helper'               => ' ',
            'remember_token'             => 'Remember Token',
            'remember_token_helper'      => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'identity'                   => 'Identity',
            'identity_helper'            => ' ',
            'interest'                   => 'Interest',
            'interest_helper'            => ' ',
            'age'                        => 'Age',
            'age_helper'                 => ' ',
            'relation_preference'        => 'Relation Preference',
            'relation_preference_helper' => ' ',
            'fav_drink'                  => 'Fav Drink',
            'fav_drink_helper'           => ' ',
            'fav_song'                   => 'Fav Song',
            'fav_song_helper'            => ' ',
            'hobbies'                    => 'Hobbies',
            'hobbies_helper'             => ' ',
            'my_dislikes'                => 'My Dislikes (petPeeve)',
            'my_dislikes_helper'         => ' ',
            'locations'                  => 'Locations',
            'locations_helper'           => ' ',
        ],
    ],
    'location' => [
        'title'          => 'Locations',
        'title_singular' => 'Location',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'location'          => 'Location',
            'location_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'qr_code'           => 'Qr Code',
            'qr_code_helper'    => ' ',
        ],
    ],
    'qrCode' => [
        'title'          => 'Qr Codes',
        'title_singular' => 'Qr Code',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'qr_code'           => 'Qr Code',
            'qr_code_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];