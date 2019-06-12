<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Page Not Found</div>

                    <div class="card-body">
                    <center>
                        Error! <br>
                        PAGE NOT FOUND
                    </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
             setTimeout(function(){
                    NProgress.done()
                    }, 3000);
        }
    }
</script>
