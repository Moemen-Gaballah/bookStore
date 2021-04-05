<template>
    <div class="Home">
        <Slider/>
        <slider-products/>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Home Component</div>

                        <div class="card-body">
                            I'm an example From Home component.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Slider from '../../layouts/Slider'
    import SliderProducts from '../../layouts/SliderProducts'
    export default {
        mounted() {

        }
    }
</script>
