<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Hangman.php";

    session_start();

    if (empty($_SESSION['guesses'])) {
        $_SESSION['guesses'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


    $app->get("/", function() use ($app) {

        $hangman = new Hangman();
        $hangman->save();
        return $app['twig']->render('main.html.twig', array('guesses' => $_SESSION['guesses']));
        // return var_dump($hangman);
    });

    $app->post("/guess", function() use ($app) {

        $hangman = $_SESSION['guesses'];
        $status = $hangman->compare($_POST['guessLetter']);

        return $app['twig']->render('main.html.twig', array('status' => $status));
    });

    return $app;
    ?>
