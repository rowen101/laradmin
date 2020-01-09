<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
           {{appendtext}} Topic
        </div>

        <div class="card-body">
         
          <form>
               <div class="alert alert-danger" v-if="!isShowAlert" role="alert" :show="errors.length > 0">
            <h6 class="alert-heading">Please fill in all required field!</h6>
            <ul>
              <li v-for="(error,i) in errors" :key="`error-${i}`">{{ error }}</li>
            </ul>
          </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Topic</label>
              <input type="text" v-model.trim="form.Topic" class="form-control" />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Description</label>
              <textarea class="form-control" v-model.trim="form.description" rows="3"></textarea>
            </div>
          </form>
        <button class="btn btn-primary" @click="onSubmit">{{appendtext}}</button>
        </div>
      </div>
      <!-- <pre>{{$data.form|JSON}}</pre> -->
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      errors: [],
      isShowAlert: true,
      appendtext: this.$route.params.id == undefined ? "Create" : "Update",
      buttonishow: this.$route.params.id == undefined ? true : false,
      form: {
        Topic: "",
        description: ""
      }
    };
  },
  computed: {},
  methods: {
    checkForm: function() {
      if (this.form.Topic && this.form.description) {
        return true;
      } else {
        this.isShowAlert= false,
        this.errors = [];

        if (!this.form.Topic) {
          this.errors.push("Topic required.");
        }

        if (!this.form.description) {
          this.errors.push("Description required.");
        }

        return false;
      }
    },
    onSubmit: function(evt) {
      evt.preventDefault();
      if (this.checkForm() == false) {
        return;
      }
     if(this.appendtext == "Create"){
        axios
        .post("http://127.0.0.1:8000/api/created", this.form)
        .then(response => {
          console.log(response);
           
           this.isShowAlert = true;
              this.$bvToast.toast(this.form.Topic +` Successfully Save `, {
          title: 'System Message',
          autoHideDelay: 5000,
          variant: 'success',
         
        })
         this.form.Topic = "";
          this.form.description = "";
        })
        .catch(function(error) {
          console.log(error);
        });
     }else if(this.appendtext == "Update"){
        axios
        .put("http://127.0.0.1:8000/api/update/" + this.$route.params.id, this.form)
        .then(response => {
          console.log(response);
          this.$bvToast.toast(this.form.Topic +` Update Successfully `, {
          title: 'System Message',
          autoHideDelay: 5000,
          variant: 'success',
         
        })
           this.isShowAlert = true;
       
        })
        .catch(function(error) {
          console.log(error);
        });
     }
     
  
    },
    getData:function(){
      axios.get("http://127.0.0.1:8000/api/edit/" + this.$route.params.id )
        .then(response => {
          console.log(response);
          this.form = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },
  watch: {},
  created: function() {
    this.getData();
  }
};
</script>
