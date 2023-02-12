<?php

/*
 *
 * this is schema example you should follow this structure
 *
 *
 * */



return [
    "schema" => [
        "accounts" => [
            "columns" => [
                "accounts"=> \Illuminate\Support\Facades\Schema::getColumnListing('accounts'),
                "requests"=> \Illuminate\Support\Facades\Schema::getColumnListing('requests'),
                "cars"=> \Illuminate\Support\Facades\Schema::getColumnListing('cars'),

            ],
            "relationships" => [
                "cars" => [
                    "name" =>"cars",
                    "first" => "cars.account_id",
                    "second" => "accounts.id",
                    "columns" => [
                        ["name" => "quantity", "type" => "integer", "options" => []]
                    ],

                ],
                "requests" => [
                    "name"=>"requests",
                    "first" => "requests.customer_id",
                    "second" => "accounts.id",
                    "columns" => [
                        ["name" => "quantity", "type" => "integer", "options" => []]
                    ],

                ],
            ],
        ],
        "requests" => [
            "columns" => [
                "requests"=> \Illuminate\Support\Facades\Schema::getColumnListing('requests'),
            ],
        ],
        "cars" => [
            "columns" => [
                ["name" => "id", "type" => "integer", "options" => ["countable", "sortable"]]
            ],
        ]
    ]
];
