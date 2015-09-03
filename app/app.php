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

    //*****************//
    //USER LOGIN STUFF//
    //***************//
    session_start();
    if (empty($_SESSION['user'])) {
       $_SESSION['user'] = array();
    }

    //Add user as a global twig variable
    if (empty($login_status)) {
        $login_status = array();
    }
    $app['twig']->addGlobal('login_status', $login_status);




    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get('/', function() use ($app) {
        $all_beers = Beer::getAll();
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        return $app['twig']->render('index.html.twig', array('all_beers' => $all_beers, 'all_breweries' => Brewery::getAll(), 'all_pubs' => Pub::getAll()));
    });

    //validate signin
    $app->post('/sign_in', function() use ($app) {
        $email = $_POST['username'];
        $user = Drunk::findByEmail($email);
        $all_beers = Beer::getAll();
        if ($user == null) {
            $login_status = ['fail'];
            $_SESSION['user'] = null;
            $app['twig']->addGlobal('logged_user', $_SESSION['user']);
            return $app['twig']->render('index.html.twig', array('login_status' => $login_status, 'all_beers' => $all_beers, 'all_breweries' => Brewery::getAll(), 'all_pubs' => Pub::getAll()));
        } elseif ($user->getPassword() != $_POST['password'])
        {
            $login_status = ['fail'];
            $_SESSION['user'] = null;
            $app['twig']->addGlobal('logged_user', $_SESSION['user']);
            return $app['twig']->render('index.html.twig', array('login_status' => $login_status, 'all_beers' => $all_beers, 'all_breweries' => Brewery::getAll(), 'all_pubs' => Pub::getAll()));
        } else {
            $_SESSION['user'] = $user;
            $app['twig']->addGlobal('logged_user', $_SESSION['user']);
            return $app['twig']->render('index.html.twig', array('all_beers' => $all_beers, 'all_breweries' => Brewery::getAll(), 'all_pubs' => Pub::getAll()));
        }
    });
    //Logout of website
    $app->get('/logout', function() use ($app) {
        $_SESSION['user'] = null;
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $all_beers = Beer::getAll();
        return $app['twig']->render('index.html.twig', array('all_beers' => $all_beers, 'all_breweries' => Brewery::getAll(), 'all_pubs' => Pub::getAll()));
    });

    //grab search results and return matching beer if exact match
    $app->get('/search_beers', function() use ($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
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
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $all_pubs = Pub::getAll();
        return $app['twig']->render("pubs.html.twig", array('pubs' => $all_pubs));
    });

    //takes a user to a page listing all Breweries
    $app->get('/breweries', function() use ($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $all_breweries = Brewery::getAll();
        return $app['twig']->render('breweries.html.twig', array('breweries' =>$all_breweries));
    });

    //takes user to a page for a specific brewery
    $app->get('/brewery_info/{id}', function($id) use ($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $brewery = Brewery::find($id);
        $beers = $brewery->getBeers();
        return $app['twig']->render('brewery_info.html.twig', array('brewery' => $brewery, 'beers' => $beers));
    });

    //takes user to a page for a specific pub from a clicked link
    $app->get('/pub_info/{id}', function($id) use ($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $pub = Pub::find($id);
        $beers_on_tap = $pub->getBeers();
        return $app['twig']->render('pub_info.html.twig', array('pub' => $pub, 'beers' => $beers_on_tap));
    });

    //takes user back to page with specific beer and all pubs serving that beer linked
    $app->get('/beer/{id}', function($id) use ($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $beer = Beer::find($id);
        $pubs_on_tap = $beer->getPubs();
        return $app['twig']->render('beer2.html.twig', array('beer' => $beer, 'pubs' => $pubs_on_tap));
    });

    //takes pub user to a page where they can add a pub
    $app->get('/pub_login', function() use ($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $all_pubs = Pub::getAll();
        return $app['twig']->render('pub.html.twig', array('pubs' => $all_pubs));
    });

    //posts the new pub to the pubs homepage
    $app->post('/pub_login', function() use ($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $name = $_POST['name'];
        $location = $_POST['location'];
        $link = $_POST['link'];
        $new_pub = new Pub($name, $location, $link);
        $new_pub->save();
        return $app['twig']->render('pub.html.twig', array('all_pubs' => Pub::getAll()));
    });

    //deletes all the pubs
    $app->delete('/pub_login', function() use ($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        Pub::deleteAll();
        return $app['twig']->render('pub.html.twig', array('all_pubs' => Pub::getAll()));
    });

    //takes user to an individual's pub page
    $app->get('/pub/{id}', function($id) use ($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $pub = Pub::find($id);
        return $app['twig']->render('pub_profile.html.twig', array('pub' => $pub, 'beers' => $pub->getBeers()));
    });

    //allows user to add a particular beer to a particular pub
    $app->post('/pub/{id}', function($id) use ($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
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
        return $app['twig']->render('pub_profile.html.twig', array ('pub' => $pub, 'beers' => $pub->getBeers()));
    });

    //Delete an individual pub
    $app->delete('/beer/{id}/delete', function($id) use($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $pub = Pub::find($id);
        $beer = Beer::find($id);
        $pub->deleteBeer($beer);
        return $app['twig']->render('pub_profile.html.twig', array('pub' => $pub, 'beers' => $pub->getBeers()));
    });

    //User signup form
    $app->get('/signup', function() use($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        return $app['twig']->render('drunk_signup.html.twig');
    });

    //User signup posting and returning to main page (no auto-login)
    $app->post('/signup', function() use($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $all_beers = Beer::getAll();
        $new_drunk = new Drunk($_POST['name'], $_POST['date_of_birth'], $_POST['location'], $_POST['email'], $_POST['password']);
        $new_drunk->save();
        return $app['twig']->render('index.html.twig', array('all_beers' => $all_beers, 'all_breweries' => Brewery::getAll(), 'all_pubs' => Pub::getAll()));
    });

    $app->get('/pub_login/{id}', function($id) use($app) {
        $app['twig']->addGlobal('logged_user', $_SESSION['user']);
        $drunk = Drunk::find($id);
        $drunk_beers = $drunk->getBeers();
        return $app['twig']->render("drunk_profile.html.twig", array('drunk' => $drunk, 'drunk_beers' => $drunk_beers));
    });

    return $app;
?>
