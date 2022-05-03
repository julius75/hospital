<template>
  <div class="row mt-3">
     <!-- <MenuBar/> -->
     <!-- <router-view></router-view> -->
     <div class="col-12">
         <div class="card">
             <div class="card-header">My referrals</div>
             <div class="card-body">
               <table class="table  table-striped" id="example2">
                 <thead>
                   <tr>

                   <th>ID</th>
                   <th>Patient name</th>
                   <th>Contact</th>
                   <th>Referred by</th>
                   <th>Time</th>


                 </tr>
                 </thead>
                 <tbody>
                   <tr v-for="(p,index) in referrals" @key="index">
                     <td>{{index+1}}</td>
                     <td>{{p.name}}</td>
                     <td>{{p.contact}}</td>
                     <td>{{p.referred_by}}</td>
                     <td>{{p.created_at | date}}</td>

                   </tr>
                 </tbody>
               </table>
             </div>
         </div>

       </div>
  </div>

</template>

<script>
import 'bootstrap/dist/css/bootstrap.min.css';
import 'jquery/dist/jquery.min.js';
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
import "datatables.net-buttons/js/dataTables.buttons.js"
import "datatables.net-buttons/js/buttons.colVis.js"
import "datatables.net-buttons/js/buttons.flash.js"
import "datatables.net-buttons/js/buttons.html5.js"
import "datatables.net-buttons/js/buttons.print.js"
import $ from 'jquery';
export default {
  data(){
    return{
      referrals:[],
      department: this.$route.params.name,
    }

  },
  mounted:function(){
    this.fetchReferral();
  },
  methods:{
    fetchReferral:function(){
      let department = this.$route.params.name
      let uri = `/referral/${department}`
      axios.get(uri).then((response)=>{
        this.referrals = response.data
          setTimeout(function(){
                  $('#example2').DataTable(
                      {
                          pagingType: 'full_numbers',
                          pageLength: 5,
                          processing: true,
                          dom: 'Bfrtip',
                          buttons: ['copy', 'csv', 'print'
                          ]
                      }
                  );
              },
              1000
          );
      })

    }
  }
}
</script>


<style lang="css" scoped>
</style>
