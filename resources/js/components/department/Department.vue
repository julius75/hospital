<template>
        <div class="row">
           <MenuBar/>

        </div>
</template>

<script>
    import MenuBar from './MenuBar'
    export default {

        components:{
            MenuBar
        },

        async beforeRouteEnter (to,from,next){

                  console.log('Loading data...');
                  let url = '/department'
                  axios.get(url).then((response) => {

                      if(to.params.name!=response.data){
                          next('/'+response.data)
                      }
                      next();
                  }).catch((error) => {
                      console.log(error);
                  })
        }

    }
</script>
