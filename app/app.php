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

    $app->get('/pub_login', function() use ($app) {
        $all_pubs = Pub::getAll();
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

    $app->get('pub/{id}', function($id) use ($app) {
        $pub = Pub::find($id);
        $id = null;
        $name = "Lip Blaster";
        $type = "IPA";
        $abv = 4.2;
        $ibu = 10;
        $region = "Pacific Northwest";
        $brewery_id = 1;
        $test_beer = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
        $test_beer->save();

        $new_name = "Hip Hops";
        $new_type = "Pale Ale";
        $new_abv = 3.2;
        $new_ibu = 4;
        $new_region = "South Central LA";
        $new_brewery_id = 2;
        $test_beer2 = new Beer($id, $name, $type, $abv, $ibu, $region, $brewery_id);
        $test_beer2->save();

        $all_beers = Beer::getAll();
        $all_beer_names = "";
        foreach ($all_beers as $beer) {
            $all_beer_names = $all_beer_names . "{ label: '" . $beer->getName() . "' },";
        }
        return $app['twig']->render('pub_profile.html.twig', array('pub' => $pub, 'beers' => $pub->getBeers(), 'all_beer_names' => $all_beer_names));
    });

    return $app;

?>
