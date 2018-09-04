<template>
  <div class="container">
    <h2>Add Product</h2>
    <form class="form-horizontal" @submit.prevent="submitForm">
      <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="text"
                 name="name"
                 v-model="item.name"
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
                 class="form-control"
                 placeholder="Quantity"
                 v-model="item.quantity"
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
                 v-model="item.price"
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
        <label class="col-sm-2 control-label">Picture</label>
        <div class="col-sm-10">
          <input type="file"
                 name="image"
                 class="form-control"
                 placeholder="Image"
                 @change="getImage($event)"
                 v-validate="'mimes:image/jpeg,image/png'"
          >
          <div v-show="errors.has('image')" class="help-block alert alert-danger">
            {{ errors.first('image') }}
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit"
                  class="btn btn-default"
                  v-show="item.name && item.quantity && item.price"
          >Add to the List</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  export default {
    data(){
      return{
        item:{
          name:'',
          quantity:0,
          price:0,
          image:''
        }
      }
    },
    methods:{
      submitForm(){
        this.$http.post("http://localhost:8000/api/addItem",this.item)
          .then(function (response) {
            this.$router.push('/list')
          })
      },
      getImage(e){
        var filereader = new FileReader();
        filereader.readAsDataURL(e.target.files[0]);
        filereader.onload = (e)=>{
          this.item.image = e.target.result;
        }
        console.log(this.item)
      }
    }
  }
</script>
