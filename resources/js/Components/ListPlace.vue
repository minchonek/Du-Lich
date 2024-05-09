<template>
  <div class="place-table-container">
    <h2>QUẢN LÝ ĐỊA ĐIỂM</h2>
    <button class="add-place-button" @click="addPlace">Thêm Địa Điểm Mới</button>
    <table>
      <thead>
        <tr>
          <th class="table-header">ID</th>
          <th class="table-header">Tên Địa Điểm</th>
          <th class="table-header">Mô Tả</th>
          <th class="table-header">Hình Ảnh</th>
          <th class="table-header">Đánh Giá</th>
          <th class="table-header">Thuộc Quận/Huyện</th>
          <th class="table-header">Ngày Tạo</th>
          <th class="table-header">Ngày Cập Nhật</th>
          <th class="table-header action-column">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="place in places" :key="place.idplace">
          <td class="table-body-cell">{{ place.idplace }}</td>
          <td class="table-body-cell">{{ place.place_name }}</td>
          <td class="table-body-cell">{{ place.description }}</td>
          <td class="table-body-cell">
            <img :src="place.image" alt="Place Image" width="50" height="50">
          </td>
          <td class="table-body-cell">{{ place.rating }}</td>
          <td class="table-body-cell">{{ getDistrictName(place.district_id) }}</td>
          <td class="table-body-cell">{{ place.created_at }}</td>
          <td class="table-body-cell">{{ place.updated_at }}</td>
          <td class="action-column">
            <button class="action-button" @click="updatePlace(place.idplace)">Sửa</button>
            <button class="action-button" @click="deletePlace(place.idplace)">Xóa</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      places: [],
    };
  },
  methods: {
    fetchPlaces() {
      axios.get('/api/places') 
        .then(response => {
          this.places = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    addPlace() {
      const formData = new FormData();
      formData.append('place_name', 'New Place');
      formData.append('description', 'Place description');
      formData.append('image', new File([null], 'placeholder.jpg')); 
      formData.append('rating', 5);
      formData.append('district_id', 1); 

      axios.post('/api/places', formData) 
        .then(response => {
          console.log(response.data);
          this.fetchPlaces();
        })
        .catch(error => {
          console.error(error);
        });
    },
    updatePlace(id) {
      const formData = new FormData();
      formData.append('place_name', 'Updated Place');
      formData.append('description', 'Updated place description');
      formData.append('image', new File([null], 'placeholder.jpg')); 
      formData.append('rating', 4);
      formData.append('district_id', 2); 

      axios.put(`/api/places/${id}`, formData) 
        .then(response => {
          console.log(response.data);
          this.fetchPlaces();
        })
        .catch(error => {
          console.error(error);
        });
    },
    deletePlace(id) {
      axios.delete(`/api/places/${id}`)
        .then(response => {
          console.log(response.data.message);
          this.fetchPlaces();
        })
        .catch(error => {
          console.error
            console.error(error);
          });
      }
    },
    mounted() {
      this.fetchPlaces(); 
    }
  };
  </script>
  