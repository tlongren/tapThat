<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Beer.php";
    require_once __DIR__."/../src/Brewery.php";
    require_once __DIR__."/../src/Drunk.php";
    require_once __DIR__."/../src/Pub.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost:8889;dbname=tap_that';
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
    //takes user to a page for a specific brewery
    $app->get('/brewery_info/{id}', function($id) use ($app) {
        $brewery = Brewery::find($id);
        $beers = $brewery->getBeers();
        return $app['twig']->render('brewery_info.html.twig', array('brewery' => $pub, 'beers' => $beers));
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
    });

    return $app;

?>
