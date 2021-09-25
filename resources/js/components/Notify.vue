<template>
    <li class="nav-item dropdown pr-2">
            <a  class=" dropdown-toggle " href="#" 
            role="button" data-toggle="dropdown"  
            aria-expanded="false" > 
            
               <img class="pt-2 " src="https://img.icons8.com/material-sharp/40/000000/bell.png"/>    
               <span class="caret"></span>

            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" >

            <!-- <ul > -->
                    <h3 align="center" style="color:grey;"> Notifications </h3>
                <strong v-for="notification in notifications" :key="notification.id">
                    <a href="" class="dropdown-item" v-on:click="MarkAsRead(notification)">

                        <!-- <small> {{ notification.data.user.id }}</small> -->
                        <ol>
                            <li style="padding-right:80px;">
                        <b style="color:blue;">'{{ notification.data.user }}'</b>

                        has commented 
                        <!-- <b style="color:red;">'{{notification.data.comment.comments}}'</b> -->
                         on your post: 
                        
                    <img v-bind:src="'/storage/' + notification.data.post.image" width="20%" alt="">  
                           
                            </li>
                        </ol>
                        </a>

                        
                </strong>
                  
                
            </div>
    </li>
</template>

<script>
import axios from 'axios';

// import Axios from 'axios';
        export default {
          //
          props: ['notifications'],
          mounted(){
              console.log("notify" + this.image);
          },
      
          methods: {
              MarkAsRead: function(notification){
                  var data = {
                      id: notification.id
                  };
                  axios.post('/notification/read' , data).then(response => {
                      window.location.href = "/comment/" + notification.data.comment
                  });
              },
                
        // myFunction: function(){
        //     this.image = "/storage/" + notification.data.post.image
        // }
         }
        }
</script>