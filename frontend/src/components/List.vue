<template>
  <div class="container">
    <h2>Product basket</h2>
    <div id="products" class="row list-group">
      <div class="item  col-xs-4 col-lg-4" v-for="item in items">
        <div class="thumbnail">
          <img class="group list-group-image" v-bind:src="'http://localhost:8000/'+item.image" alt="" />
          <div class="caption">
            <h4 class="group inner list-group-item-heading">Name {{item.name}}</h4>
            <p class="group inner list-group-item-text"></p>
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <p class="lead">
                  Price {{item.price}}</p>
              </div>
              <div class="col-xs-12 col-md-6">
                <p class="lead">
                  Qantity {{item.qantity}}</p>
              </div>
              <div class="col-xs-12 col-md-6">
                <router-link class="btn btn-primary" :to="'/edit/'+item.id">Edit</router-link>
              </div>
              <div class="col-xs-12 col-md-6">
                <a class="btn btn-danger"  @click="deleteItem($event)" v-bind:id="item.id">Deletet</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    data(){
      return{
        items:[]
      }
    },
    created(){
      this.$http.get("http://localhost:8000/api/getItems")
        .then(function (response) {
          this.items = response.body.allItems;
        })
    },
    methods:{
      deleteItem(event){
        this.$http.delete("http://localhost:8000/api/deleteItem/"+event.target.id)
          .then(function (response) {
            var position = this.items.findIndex(function (element) {
              return element.id = event.target.id;
            })
            this.items.splice(position,1)
          })
      }
    }
  }
</script>
