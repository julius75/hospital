<template>

<div class="container">

    <div class="d-flex" id="wrapper">

      <!-- Sidebar -->
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Dashboard</div>
        <div class="list-group list-group-flush">
          <router-link :to="{ name: 'depQueue', params:'department' }" class="list-group-item list-group-item-action bg-light">Queue</router-link>
          <router-link :to="{ name: 'showReports' }" class="list-group-item list-group-item-action bg-light">Report</router-link>
          <router-link :to="{ name: 'showReferrals' }" class="list-group-item list-group-item-action bg-light">My Referrals</router-link>

        </div>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>


        </nav>

        <div class="container-fluid">
            <router-view></router-view>
        </div>
      </div>
      <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

</div>


</template>

<script>
export default {
    name: "MenuBar",
    data(){
        return{
          department: this.$route.params.department
        }
    },
}
</script>

<style>

</style>
