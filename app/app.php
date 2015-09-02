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

    //takes user to a page listing all pubs
    $app->get('/pubs', function() use ($app) {
        $all_pubs = Pub::getAll();
        return $app['twig']->render("pubs.html.twig", array('pubs' => $all_pubs));
    });

    //takes a user to a page listing all Breweries
    $app->get('/breweries', function() use ($app) {
        $all_breweries = Brewery::getAll();
        return $app['twig']->render('breweries.html.twig', array('breweries' =>$all_breweries));
    });

    //takes user to a page for a specific brewery
    $app->get('/brewery_info/{id}', function($id) use ($app) {
        $brewery = Brewery::find($id);
        $beers = $brewery->getBeers();
        return $app['twig']->render('brewery_info.html.twig', array('brewery' => $brewery, 'beers' => $beers));
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

    //takes pub user to a page where they can add a pub
    $app->get('/pub_login', function() use ($app) {
        $all_pubs = Pub::getAll();
        return $app['twig']->render('pub.html.twig', array('all_pubs' => $all_pubs));
    });

    //posts the new pub to the pubs homepage
    $app->post('/pub_login', function() use ($app) {
        $name = $_POST['name'];
        $location = $_POST['location'];
        $link = $_POST['link'];
        $new_pub = new Pub($name, $location, $link);
        $new_pub->save();
        return $app['twig']->render('pub.html.twig', array('all_pubs' => Pub::getAll()));
    });

    //deletes all the pubs
    $app->delete('/pub_login', function() use ($app) {
        Pub::deleteAll();
        return $app['twig']->render('pub.html.twig', array('all_pubs' => Pub::getAll()));
    });

    //takes user to an individual's pub page
    $app->get('/pub/{id}', function($id) use ($app) {
        $pub = Pub::find($id);
        return $app['twig']->render('pub_profile.html.twig', array('pub' => $pub, 'beers' => $pub->getBeers()));
    });

    //allows user to add a particular beer to a particular pub
    $app->post('/pub/{id}', function($id) use ($app) {
        $pub = Pub::find($id);
        $beer_name = $_POST['keyword'];
        $beer = Beer::findByName($beer_name);
        $all_beers = $pub->getBeers();
        if (empty($all_beers)) {
            $pub->addBeer($beer);
        } else {
            foreach ($all_beers as $pub_beer) {
                if ($beer != $pub_beer) {
                    $pub->addBeer($beer);
                }
            }
        }
        return $app['twig']->render('pub_profile.html.twig', array ('pub' => $pub, 'beers' => $all_beers));
    });

    return $app;
?>
