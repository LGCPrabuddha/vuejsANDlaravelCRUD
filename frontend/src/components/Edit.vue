<template>
  <div class="container">
    <h2>Edit Product</h2>
    <form class="form-horizontal" @submit.prevent="updateInfo">
      <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="text"
                 name="name"
                 v-model="product.name"
                 class="form-control"
                 placeholder="Name"
                 v-validate="'required'"
                 autofocus
          >
          <div v-show="errors.has('name')" class="help-block alert alert-danger">
            {{ errors.first('name') }}
          </div>

        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Quantity</label>
        <div class="col-sm-10">
          <input type="number"
                 name="quantity"
                 v-model="product.qantity"
                 class="form-control"
                 placeholder="Quantity"
                 v-validate="'required|max_value:5'"
          >
          <div v-show="errors.has('quantity')" class="help-block alert alert-danger">
            {{ errors.first('quantity') }}
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Price P.U $</label>
        <div class="col-sm-10">
          <input type="number"
                 name="price"
                 v-model="product.price"
                 class="form-control"
                 placeholder="Price"
                 v-validate="'required|max:5'"
          >
          <div v-show="errors.has('price')" class="help-block alert alert-danger">
            {{ errors.first('price') }}
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit"
                  class="btn btn-default"

          >Update</button>
        </div>
      </div>
    </form>
  </div>

</template>
<script>
  export default {
    created(){
      this.getData();
    },
    data(){
      return{
        product:{
        }
      }
    },
    methods:{
      getData(){
        this.$http.get('http://localhost:8000/api/getItem/'+this.$route.params.id)
          .then(function (response) {
            this.product = response.body.item;
          })
      },
      updateInfo(){
        this.$http.put('http://localhost:8000/api/editItem/'+this.$route.params.id,this.product)
          .then(function (response) {
            this.$router.push('/list')
          })
      }
    }
  }
</script>
