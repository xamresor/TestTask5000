 <!DOCTYPE html>
     <html>
        <head>
            <meta charset="utf-8" />
            <title><?php write('siteName'); ?></title>
        </head>
        <body>
            <div class="wrap">

                <header>
                    <h1><?php write('title'); ?></h1>
                    <hr>
                </header>

                <?php pageContent(); ?>
            </div>
        </body>
    </html>