<template>
    <div class="sidebar" :style="{ height: sidebarHeight + 'px' }">
      <ul>
        <li>
          <a href="#" class="sidebar-link" @click="toggleSubmenu">
            Quản lý vị trí 
            <span class="arrow-icon" :class="{ 'active': isSubmenuOpen }"><i class="fas fa-chevron-down"></i></span>
          </a>
          <ul class="sidebar-submenu" :class="{ 'active': isSubmenuOpen }">
            <li><router-link to="/countries" class="sidebar-link">Quốc gia</router-link></li>
            <li><router-link to="/provinces" class="sidebar-link">Tỉnh/Thành Phố</router-link></li>
            <li><router-link to="/districts" class="sidebar-link">Quận/Huyện</router-link></li>
          </ul>
          <router-link to="/places" class="sidebar-link">Quản lý Địa điểm</router-link>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  
  export default {
    setup() {
      const isSubmenuOpen = ref(false);
      const sidebarHeight = ref(window.innerHeight);
  
      const toggleSubmenu = () => {
        isSubmenuOpen.value = !isSubmenuOpen.value;
      };
  
      onMounted(() => {
        window.addEventListener('resize', () => {
          sidebarHeight.value = window.innerHeight;
        });
      });
  
      return { toggleSubmenu, isSubmenuOpen, sidebarHeight };
    }
  }
  </script>
  
  <style>
.sidebar {
    background-color: #f0f0f0;
    width: 240px; 
  }
  
  .sidebar-heading {
    font-size: 1.25rem;
    font-weight: bold;
    padding: 1rem;
  }
  
  .sidebar-link {
    padding: 0.75rem;
    display: block;
    color: #333;
    text-decoration: none;
    transition: background-color 0.3s ease;
    position: relative;
  }
  
  .sidebar-link:hover {
    background-color: #ddd;
  }
  
  .sidebar-submenu {
    display: none;
  }
  
  .sidebar-submenu.active {
    display: block;
  }
  
  .arrow-icon {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    transition: transform 0.3s ease;
  }
  
  .arrow-icon.active {
    transform: translateY(-50%) rotate(180deg);
  }
  </style>
  