<?php

$app->curl = function ($c) use ($app) {
    return new \Curl();
};
$app->authentication = function ($c) use ($app) {
    return new \There4\Authentication\Cookie();
};

/* * ** Hooks used for logging ******** */
$app->hook('slim.before.router', function () use ($app) {
    $request = $app->request;
    $response = $app->response;

    $app->log->debug('[' . date('H:i:s', time()) . '] Request path: ' . $request->getPathInfo());
    $app->log->debug('[' . date('H:i:s', time()) . '] Request body: ' . $request->getBody());
});

$app->hook('slim.after.router', function () use ($app) {
    $request = $app->request;
    $response = $app->response;

    $app->log->debug('[' . date('H:i:s', time()) . '] Response status: ' . $response->getStatus());
});


/* * ** Hello World **** */
$app->get('/hello/:name', function ($name) use ($app) {
    echo "Hello, $name";
});