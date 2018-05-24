<?php

return [
    'adminEmail' => 'dwesoscar@gmail.com',
    'dropbox'=> new \Spatie\Dropbox\Client(getenv('DROPBOX_TOKEN')),
];
