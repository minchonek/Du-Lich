<template>
    <div>
      <AuthenticatedLayout>
        <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">ADMIN</h2>
        </template>
  
        <div class="manage">
          <Sidebar />
          <div class="main-content">
            <router-view></router-view>
          </div>
        </div>
      </AuthenticatedLayout>
    </div>
  </template>
  
<script>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import Sidebar from '@/Components/Sidebar.vue'; 
  
  export default {
    components: {
      AuthenticatedLayout,
      Sidebar, 
    },
  }
</script>
  
<style>
.manage {
  display: grid;
  grid-template-columns: 200px 1fr;
  grid-gap: 30px; 
}
</style>
  