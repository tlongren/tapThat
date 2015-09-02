<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Beer.php";
    require_once __DIR__."/../src/Brewery.php";
    require_once __DIR__."/../src/Drunk.php";
    require_once __DIR__."/../src/Pub.php";


    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=tap_that';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    //grab search results and return matching beer if exact match
    $app->get('/search_beers', function() use ($app) {
        $all_beers = Beer::getAll();
        $matching_beer = null;
        foreach ($all_beers as $beer) {
            if ($_GET['beer'] == $beer->getName()) {
                $matching_beer = $beer;
            }
        }
        $pubs_on_tap = $matching_beer->getPubs();
        return $app['twig']->render('beer.html.twig', array('beer' => $matching_beer, 'pubs' => $pubs_on_tap));
    });

    //takes user to a page for a specific pub from a clicked link
    $app->get('/pub_info/{id}', function($id) use ($app) {
        $pub = Pub::find($id);
        $beers_on_tap = $pub->getBeers();
        return $app['twig']->render('pub_info.html.twig', array('pub' => $pub, 'beers' => $beers_on_tap));
    });

    //takes user back to page with specific beer and all pubs serving that beer linked
    $app->get('/beer/{id}', function($id) use ($app) {
        $beer = Beer::find($id);
        $pubs_on_tap = $beer->getPubs();
        return $app['twig']->render('beer.html.twig', array('beer' => $beer, 'pubs' => $pubs_on_tap));

    $app->get('/pub_login', function() use ($app) {
        return $app['twig']->render('pub.html.twig', array('all_pubs' => $all_pubs));
    });

    $app->post('/pub_login', function() use ($app) {
        $name = $_POST['name'];
        $location = $_POST['location'];
        $link = $_POST['link'];
        $new_pub = new Pub($name, $location, $link);
        $new_pub->save();
        return $app['twig']->render('pub.html.twig', array('all_pubs' => Pub::getAll()));
    });

    $app->delete('/pub_login', function() use ($app) {
        Pub::deleteAll();
        return $app['twig']->render('pub.html.twig', array('all_pubs' => Pub::getAll()));
    });

    $app->get('/pub/{id}', function($id) use ($app) {
        $pub = Pub::find($id);
        return $app['twig']->render('pub_profile.html.twig', array('pub' => $pub, 'beers' => $pub->getBeers()));
    });

    return $app;

?>
