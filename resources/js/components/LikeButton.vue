<template>
    <div>
        
            <button class="btn btn-primary " @click="likeUser" v-text="button">
                
            </button>
            <!-- <button class="btn btn-primary ml-4" @click="likeUser" v-if="userId.length != 0">
                like
            </button> -->
            
        <br>

                <strong style="margin-bottom:25px;" >{{likesCount.length}} </strong > like
            
               <!-- <strong v-for="like-button in likes" :key="like-button.id"> -->
                    <!-- <a href="" class="dropdown-item" v-on:click="MarkAsRead(notification)">


                        <ol>
                            <li style="padding-right:80px;">
                        <b style="color:blue;">'{{ notification.data.user }}'</b>

                        has commented 
                         on your post: 
                        
                    <img v-bind:src="'/storage/' + notification.data.post.image" width="20%" alt="">  
                           
                            </li>
                        </ol>
                        </a> -->

                        
                <!-- </strong> -->
    </div>   

</template>

<script>
  export default {
        props: ['postId','likes', 'userId'],
        created(){
             this.likesCount = this.likes;
            //  this.likes.length;
        },
        mounted() {
            console.log('Component mounted.' + this.buttonText);
            // console.log(this.likes[0].user_id == this.userId);
            // this.button();
        },
        data(){
            return {

               likesCount:[{
                   likeid:0
               }],
               buttonText:""
               
            }
        },
        
    methods: {
        likeUser(){
            if(this.userId){

                axios.post('/saveLike', {
                    id: this.postId
                }).then(response => {
                    if(response.data == 'deleted'){
                        const element = this.likesCount.length;
                        const isLargeNumber =  element > 0;
                        console.log("hello " + element);

                      const index = this.likesCount.findIndex(isLargeNumber);

                       this.likesCount.splice(index, 1);
                    }else{
                    this.likesCount.push({ likeid: this.likesCount.length});
                    }
                    // this.status = ! this.status;
                    // console.log(response);
                })
                .catch(errors => {
                  //   if(errors.response.status ==  401){
                  //       window.location = '/login';
      
                  //   }
                  console.log(errors);
                });
            }else{
                window.location= 'login'
            }
        }
    },
    computed: {
        button(){
            if(!(this.likes.length > 0)){
               return this.buttonText = "Like";
                
            }
            this.likes.forEach(like => {
              
                    if(like.user_id == this.userId){

                        return this.buttonText = "Unlike";     
                    }
                else{
                   return this.buttonText = "Like";

                }
            });
            return this.buttonText;
        }
    }
}
</script>