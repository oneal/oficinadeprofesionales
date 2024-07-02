<?php

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if (file_exists('functions.php')) {
    include('functions.php');
}

header("Content-Type: text/xml");
 
// Inicio la estructura de mi archivo XML 
echo "<?xml version='1.0' encoding='iso-8859-1' ?>" .
"<urlset xmlns='https://www.sitemaps.org/schemas/sitemap/0.9'>";	

echo "<url>
        <loc>".$webpage_full_link."</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
 </url>";

echo "<url>
        <loc>".$webpage_full_link."nuestro-compromiso</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
  </url>";

echo "<url>
        <loc>".$webpage_full_link."todas-categorias</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
  </url>";

echo "<url>
        <loc>".$webpage_full_link."contacto</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
  </url>";

echo "<url>
        <loc>".$webpage_full_link."Login</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
  </url>";

echo "<url>
        <loc>".$webpage_full_link."anuncios</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
  </url>";
$categories = getAllCategories();
if ($categories->num_rows > 0) {
    foreach($categories as $category) {
        echo "<url>
                <loc>".$webpage_full_link."anuncios/".$category['category_slug']."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>";
        
        $states = getAllStates(1);
        if ($states->num_rows > 0) {
            foreach($states as $state) {
                echo "<url>
                        <loc>".$webpage_full_link."anuncios/".$category['category_slug']."/".$state['state_slug']."</loc>
                        <changefreq>weekly</changefreq>
                        <priority>0.8</priority>
                    </url>";
                $cities = getAllCitiesIdState($state['state_id']);
                if ($cities->num_rows > 0) {
                    foreach ($cities as $city) {
                        echo "<url>
                            <loc>".$webpage_full_link."anuncios/".$category['category_slug']."/".$city['city_slug']."/".$state['state_slug']. "</loc>
                            <changefreq>weekly</changefreq>
                            <priority>0.8</priority>
                        </url>";
                    }                    
                }
            }
        }
        
    }
}
echo "<url>
        <loc>".$webpage_full_link."ofertas-trabajo</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
  </url>";
$categories = getAllCategoriesWorkOffer();
if ($categories->num_rows > 0) {
    foreach($categories as $category) {
        echo "<url>
                <loc>".$webpage_full_link."ofertas-trabajo/".$category['category_slug']."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>";

        $states = getAllStates(1);
        if ($states->num_rows > 0) {
            foreach($states as $state) {
                echo "<url>
                        <loc>".$webpage_full_link."ofertas-trabajo/".$category['category_slug']."/".$state['state_slug']."</loc>
                        <changefreq>weekly</changefreq>
                        <priority>0.8</priority>
                    </url>";
                $cities = getAllCitiesIdState($state['state_id']);
                if ($cities->num_rows > 0) {
                    foreach ($cities as $city) {
                        echo "<url>
                            <loc>".$webpage_full_link."ofertas-trabajo/".$category['category_slug']."/".$city['city_slug']."/".$state['state_slug']. "</loc>
                            <changefreq>weekly</changefreq>
                            <priority>0.8</priority>
                        </url>";
                    }
                }
            }
        }

    }
}

echo "<url>
        <loc>".$webpage_full_link."almacenes</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
  </url>";
$categories = getAllCategoriesStores();
if ($categories->num_rows > 0) {
    foreach($categories as $category) {
        echo "<url>
                <loc>".$webpage_full_link."almacenes/".$category['category_slug']."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>";

        $states = getAllStates(1);
        if ($states->num_rows > 0) {
            foreach($states as $state) {
                echo "<url>
                        <loc>".$webpage_full_link."almacenes/".$category['category_slug']."/".$state['state_slug']."</loc>
                        <changefreq>weekly</changefreq>
                        <priority>0.8</priority>
                    </url>";
                $cities = getAllCitiesIdState($state['state_id']);
                if ($cities->num_rows > 0) {
                    foreach ($cities as $city) {
                        echo "<url>
                            <loc>".$webpage_full_link."almacenes/".$category['category_slug']."/".$city['city_slug']."/".$state['state_slug']. "</loc>
                            <changefreq>weekly</changefreq>
                            <priority>0.8</priority>
                        </url>";
                    }
                }
            }
        }

    }
}

echo "<url>
        <loc>".$webpage_full_link."eventos</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
  </url>";

$events = getAllEvents();
if ($events->num_rows > 0) {
    foreach($events as $event) {
        echo "<url>
                <loc>".$webpage_full_link."evento/".$event['event_slug']."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>";
    }
}

echo "<url>
        <loc>".$webpage_full_link."blog-posts</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
  </url>";

$blogs = getAllBlogs();
if ($blogs->num_rows > 0) {
    foreach($blogs as $blog) {
        echo "<url>
                <loc>".$webpage_full_link."blog/".$blog['blog_slug']."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>";
    }
}

echo "<url>
        <loc>".$webpage_full_link."comunidad-negocios</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
  </url>";

$users = getAllUser();
if ($users->num_rows > 0) {
    foreach($users as $user) {
        echo "<url>
                <loc>".$webpage_full_link."profesional/".$user['user_slug']."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>";
    }
}

$offers = getAllOffersStores();
if ($offers->num_rows > 0) {
    foreach($offers as $offer) {
        echo "<url>
                <loc>".$webpage_full_link."oferta-almacen/".$offer['offer_slug']."</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>";
    }
}

// Cierre de la etiqueta del archivo XML del Sitemap
echo "</urlset>";
