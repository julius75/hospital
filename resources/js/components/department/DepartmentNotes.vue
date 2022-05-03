<template>
  <div class="row mt-3">
     <!-- <MenuBar/> -->
     <!-- <router-view></router-view> -->

     <div v-if="showModal">
     <transition name="modal">
     <div class="modal-mask">
     <div class="modal-wrapper">

     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Referral</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true" @click="showModal = false">&times;</span>
                 </button>
             </div>
             <div class="modal-body" id="modal-body">
                 <form  method="post">
                     <div class="form-group">
                       <label for="">Department</label>
                       <select class="form-control" v-model="dep">
                         <option value="">Choose department</option>
                         <option :key="d" v-for="d in departments">{{d}}</option>
                       </select>
                     </div>
                   </form>
                 </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" @click="referTo">Refer</button>
             </div>
         </div>
     </div>

     </div>
     </div>
     </transition>
   </div>
     <div class="col-12">
         <div class="card">
             <div class="card-header">Patient Notes ({{patientName}})</div>
             <div class="card-body">
               <form class="" @submit.prevent="addNotes" method="post">
                 <div class="form-group">
                   <label for="">{{patientName}} Notes</label>
                   <textarea class="form-control" v-model="notes"  cols="8" rows="8"></textarea>

                 </div>
                 <div class="form-group">
                        <input type="submit" name="save" class="btn btn-primary btn-sm" value="Save">
                 </div>
               </form>
               <button type="button" @click="showModal = true" class="btn btn-secondary btn-sm" name="button">Referral</button>
             </div>
         </div>

       </div>
  </div>

</template>

<script>
export default {
  data(){
    return{
      departments:[
        'laboratory',
        'radiology',    //Allowed referrals
        'optical',
        'treatment'

      ],
      patientName:this.$route.params.patientName,
      notes:'',
      showModal:false,
      dep:''
    }

  },

  methods:{

    addNotes:function(){

      let department = this.$route.params.name   //fetches department from the form route

      let patientID = this.$route.params.patientID // fetches the patient ID

      let notes =this.notes // fetches the notes

      let uri = `/notes/create`
      axios.post(uri,
        {
          department,
          patientID,
          notes
        }).then((response)=>{
          this.notes = ''
          alert("Notes added succesfully")
      }).catch(error => {
          console.log(error);
      })

    },
    referTo:function(){
      let patientID = this.$route.params.patientID
      let referredBy = this.$route.params.department
      let referTo = this.dep
      let uri = `/referral/create`
      axios.post(uri,
        {
          patientID,
          referredBy,
          referTo
        }).then((response)=>{
          this.dep = ''
          this.showModal = false
          alert("Patient referred succesfully")
      }).catch(error => {
          console.log(error);
      })
    }

  }
}
 </script>

 <style lang="css" scoped>
 .table>tbody>tr>td, .table>tfoot>tr>td{
 vertical-align: middle;
 }
 @media screen and (max-width: 600px) {
 table#cart tbody td .form-control{
 width:20%;
 display: inline !important;
 }
 .actions .btn{
 width:36%;
 margin:1.5em 0;
 }

 .actions .btn-info{
 float:left;
 }
 .actions .btn-danger{
 float:right;
 }

 table#cart thead { display: none; }
 table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
 table#cart tbody tr td:first-child { background: #333; color: #fff; }
 table#cart tbody td:before {
 content: attr(data-th); font-weight: bold;
 display: inline-block; width: 8rem;




 }
 }



 table#cart tfoot td{display:block; }
 table#cart tfoot td .btn{display:block;}
 .messageVide {
 font-size: 25px;
 width: 100%;
 background-color: #c2dae8;
 padding: 1.5em 0;
 border-radius: 5px;
 font-weight: lighter;
 display: inline-block;
 text-align: center;
 }
 .modal-mask {
 position: fixed;
 z-index: 9998;
 top: 0;
 left: 0;
 width: 100%;
 height: 100%;
 background-color: rgba(0, 0, 0, .5);
 display: table;
 transition: opacity .3s ease;
 }
 .modal-header {
 background-color: #34373d;
 }
 .modal-title {
 color: #fff;
 }
 .close {
 color: #fff;
 }
 .modal-wrapper {
 display: table-cell;
 vertical-align: middle;
 }
 .modal-body {
 max-height: calc(100vh - 210px);
 overflow-y: auto;
 }
 #card-details {
 max-height: calc(100vh - 210px);
 overflow-y: auto;
 }
 #product-details {
 max-height: calc(100vh - 210px);
 overflow-y: auto;
 }
 </style>
