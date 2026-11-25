<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Virtual Art Museum is a website that allows you to explore and discover art from around the world.">

    <title>Explore | Virtual Art Museum</title>
    
    <link rel="icon" type="image/png" href="../image/favicon/favicon.webp">


    <link rel="stylesheet" href="../style/general.css">
    <link rel="stylesheet" href="../style/Navegador.css">
</head>

<body>
    <!-- Enlace de accesibilidad para saltar al contenido principal -->
    <a class="skip-link" href="#main">Skip to content</a>

    <!-- Encabezado con el nombre del museo y la navegación principal -->
    <header class="header">
        <a class="brand" href="./Home.html">Virtual Art <span>Museum.</span></a>
        <nav class="navigation" aria-label="Main navigation">
            <a href="./Home.html">Home</a>
            <a class="active" href="#collection">Explore</a>
        </nav>
    </header>

    <main id="main">

        <!-- Sección de presentación con una ilustración y un enlace a la colección -->
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-text">
                <h1 id="hero-title">Find your next<br><span>inspiration.</span></h1>
                <a class="button" href="#collection">Explore the collection <span aria-hidden="true">↗</span></a>
            </div>
            <div class="hero-art">
                <span class="colour-block" aria-hidden="true"></span>
                <img src="../image/arrPlan/Iglesia.webp" alt="Watercolour illustration of a stone church" width="600" height="600">
            </div>
        </section>

        <!-- Galería de obras. Más adelante, las tarjetas se generarán con un bucle en PHP. -->
        <section class="collection" id="collection" aria-labelledby="collection-title">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">The collection</p>
                    <h2 id="collection-title">A few things to find your inspiration.</h2>
                </div>
            </div>

            <!-- Cada tarjeta muestra una obra, su categoría y su título, y enlaza a la imagen. -->
            <div class="gallery">
                <article>
                    <a class="art-card" href="../image/chamaa.webp">
                        <div class="art-image">
                            <img src="../image/chamaa.webp" alt="lit candle" loading="lazy">
                        </div>

                        <div class="art-caption">
                            <p class="category">Architecture</p>
                            <h3>Quiet corners</h3>
                        </div>
                    </a>
                </article>

                <article>
                    <a class="art-card" href="../image/beyond the clouds.webp">
                        <div class="art-image">
                            <img src="../image/beyond the clouds.webp" alt="clouds" loading="lazy">
                        </div>

                        <div class="art-caption">
                            <p class="category">Places &amp; stories</p>
                            <h3>Beyond the clouds</h3>
                        </div>
                    </a>
                </article>

                <article>
                    <a class="art-card" href="../image/coeur.webp">
                        <div class="art-image">
                            <img src="../image/coeur.webp" alt="heart" loading="lazy">
                        </div>
                        <div class="art-caption">
                            <p class="category">Expression</p>
                            <h3>A little feeling</h3>
                        </div>
                    </a>
                </article>
            </div>
        </section>
    </main>

    <footer class="footer">
        <a class="brand" href="./Home.html">Virtual Art Museum.</a>
        <p>Where art comes to life.</p><a href="#main">Back to top ↑</a>
    </footer>
</body>
</html>