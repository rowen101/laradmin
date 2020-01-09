<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          View All Topics
          <button
            id="printexport"
            class="btn btn-sm btn-info float-right"
            @click="$router.push('/create/topic')"
          >Add</button>
        </div>
        <div class="card-body">
          <b-table
            show-empty
            stacked="md"
            responsive="sm"
            hover
           
            striped
            fixed
            head-variant="light"
            :items="items"
             :fields="fields"
          >
            <template v-slot:cell(actions)="row" >
              <router-link
                tag="button"
                :to="'/modify/topic/' + row.item.id"
                class="btn btn-primary   btn-square"
              >
                <b-icon icon="pencil"></b-icon>
              </router-link>&nbsp;
              <b-button
              
                variant="danger"
                class="btn btn-danger  btn-square"
                @click="onSelecteItemToDelete(row.item)"
              >
               <b-icon icon="trash-fill"></b-icon>
              </b-button>
            </template>
          </b-table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      fields: [
         
        {key: 'Topic', sortable: true},
         {key: 'description', sortable: true},
          { key: 'actions', label: 'Actions' },
      ],
      items: []
    };
  },
  methods: {
    gettopiclist: function() {
      axios
        .get("http://127.0.0.1:8000/api/viewall")
        .then(response => {
          console.log(response);
          this.items = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    onSelecteItemToDelete:function(val){
      axios.delete("http://127.0.0.1:8000/api/destroy/" + val.id)
      .then(resp => {
         this.gettopiclist();
         this.$bvToast.toast('Successfully Delete' + resp.data.Topic, {
          title: 'Delete',
          variant: danger,
          solid: true
        })
        
      })
      .catch(function(err){
        console.log(err);
      });
    }
  },
  computed: {},
  watch: {},
  created: function() {
    this.gettopiclist();
  }
};
</script>