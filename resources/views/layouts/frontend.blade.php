<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Book Store | Moemen</title>
        <link rel="stylesheet" href="/css/carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="/css/carousel/owl.theme.default.css">
         <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            <Navbar></Navbar>
            <Slider></Slider>
            <slider-products></slider-products>
            <slider-products></slider-products>
            <slider-products></slider-products>
            <slider-products></slider-products>
            <slider-products></slider-products>
            <feature-payment></feature-payment>
            <Testimonials></Testimonials>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
