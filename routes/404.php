<?php
/*
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$customErrorHandler = function (
    Psr\Http\Message\ServerRequestInterface $request,
    \Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {
    $response = $app->getResponseFactory()->createResponse();
    // seems the followin can be replaced by your custom response
    // $page = new Alvaro\Pages\Error($c);
    // return $page->notFound404($request, $response);
    $response->getBody()->write('Página não disponível');
    return $response->withStatus(404);
};

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
// Register the handler to handle only  HttpNotFoundException
// Changing the first parameter registers the error handler for other types of exceptions
$errorMiddleware->setErrorHandler(Slim\Exception\HttpNotFoundException::class, $customErrorHandler);