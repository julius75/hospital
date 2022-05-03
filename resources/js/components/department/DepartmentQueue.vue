<template>
  <div class="row mt-3">
     <!-- <MenuBar/> -->
     <!-- <router-view></router-view> -->
     <div class="col-12">
         <div class="card">
             <div class="card-header">Patient Queue (IN ORDER OF TIME)</div>
             <div class="card-body">
               <table class="table  table-striped" id="example1">
                 <thead>
                   <tr>
                   <th>#</th>
                   <th>Patient name</th>
                   <th>Contact</th>
                   <th>Time</th>
                   <th>Action</th>

                 </tr>
                 </thead>
                 <tbody>
                   <tr v-for="(p,index) in queue" @key="index">
                     <td>{{index+1}}</td>
                     <td>{{p.name}}</td>
                     <td>{{p.contact}}</td>
                     <td>{{p.created_at | date}}</td>
                     <td>
                      <router-link :to="{ name: 'notes', params: {department:name, patientID:p.patient_id, patientName:p.name} }" class="btn btn-secondary btn-sm">Call</router-link>
                     </td>
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
      queue:[],
      department: this.$route.params.name,
    }

  },
  mounted:function(){
    this.fetchPatientQueue();
  },
  methods:{
    fetchPatientQueue:function(){
      let department = this.$route.params.name
      let uri = `/queue/${department}`
      axios.get(uri).then((response)=>{
        this.queue = response.data
          setTimeout(function(){
                  $('#example1').DataTable(
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
