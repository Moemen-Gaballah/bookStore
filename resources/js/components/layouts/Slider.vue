<template>
    <div class="slider">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            <!-- <li data-target="#carouselExampleIndicators" data-slide-to="5"></li> -->
          </ol>
          <!-- <div class="container"> -->
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="img/slider/3.jpg" alt="First slide">
                </div>
                <div class="carousel-item ">
                  <img class="d-block w-100" src="img/slider/4.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="img/slider/6.jpg" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="img/slider/8.jpg" alt="fourth slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="img/slider/9.jpg" alt="fifth slide">
                </div>
              </div>
          <!-- </div> -->
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>

    </div>
    </div>
</template>

<style scoped>
    .slider {
        height: 562px !important;
        overflow: hidden;
    }

    .slider .carousel{
        width: 100%;
        height: 100%;
    }

    .slider .carousel-indicators li{
        height: 6px;
    }

    .slider .carousel-inner, .carousel-item.active,.carousel-item,.slider .carousel-inner img{
        width: 100% !important;
        height: 100% !important;
    }

    @media (max-width: 768px) {
        .slider {
            height: 400px !important;
        }

     }

</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
