<template>
  <div class="province-table-container">
    <h2>QUẢN LÝ TỈNH/THÀNH PHỐ</h2>
    <button class="add-province-button" @click="addProvince">Thêm Tỉnh/Thành Phố Mới</button>
    <table>
      <thead>
        <tr>
          <th class="table-header">ID</th>
          <th class="table-header">Tên Tỉnh/Thành Phố</th>
          <th class="table-header">Thuộc Quốc Gia</th>
          <th class="table-header">Ngày Tạo</th>
          <th class="table-header">Ngày Cập Nhật</th>
          <th class="table-header action-column">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="province in provinces" :key="province.idprovince">
          <td class="table-body-cell">{{ province.idprovince }}</td>
          <td class="table-body-cell">{{ province.province_name }}</td>
          <td class="table-body-cell">
            {{ getCountryName(province.country_id) }}
          </td>
          <td class="table-body-cell">{{ province.created_at }}</td>
          <td class="table-body-cell">{{ province.updated_at }}</td>
          <td class="action-column">
            <button class="action-button" @click="updateProvince(province.idprovince)">Sửa</button>
            <button class="action-button" @click="deleteProvince(province.idprovince)">Xóa</button>
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
      provinces: [],
    };
  },
  methods: {
    fetchProvinces() {
      axios.get('/api/provinces') 
        .then(response => {
          this.provinces = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    addProvince() {
      axios.post('/api/provinces', { province_name: 'New Province' }) 
        .then(response => {
          console.log(response.data);
          this.fetchProvinces();
        })
        .catch(error => {
          console.error(error);
        });
    },
    updateProvince(id) {
      axios.put(`/api/provinces/${id}`, { province_name: 'Updated Province' }) 
        .then(response => {
          console.log(response.data);
          this.fetchProvinces();
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteProvince(id) {
      axios.delete(`/api/provinces/${id}`)
        .then(response => {
          console.log(response.data.message);
          this.fetchProvinces();
        })
        .catch(error => {
          console.error(error);
        });
    },
    
    getCountryName(countryId) {
      return `Country Name (replace with actual name)`;
    },
  },
  mounted() {
    this.fetchProvinces();
  },
};
</script>

<style>
.province-table-container {
  margin: 40px auto;
  width: 80%;
  max-width: 1000px;
  border-collapse: collapse;
}

h2 {
  font-size: 30px;
  text-align: center;
}

table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #ddd;
}

thead {
  background-color: #f0f0f0;
  text-align: center;
}

th {
  padding: 10px;
  border: 1px solid #ddd;
  font-weight: bold;
}

tbody tr {
  background-color: #fff;
  text-align: center;
}

td {
  padding: 10px;
  border: 1px solid #ddd;
}

.action-column {
  width: 100px;
}

.action-button {
  margin: 5px;
  padding: 5px 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  cursor: pointer;
}

.action-button:hover {
  background-color: #eee;
}

.add-province-button {
  margin: 20px 0;
  padding: 10px 20px;
  background-color: #4CAF50; 
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.add-province-button:hover {
  background-color: #45a049; 
}
</style>