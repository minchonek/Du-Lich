<template>
  <div class="district-table-container">
    <h2>QUẢN LÝ QUẬN/HUYỆN</h2>
    <button class="add-district-button" @click="addDistrict">Thêm Quận/Huyện Mới</button>
    <table>
      <thead>
        <tr>
          <th class="table-header">ID</th>
          <th class="table-header">Tên Quận/Huyện</th>
          <th class="table-header">Thuộc Tỉnh/Thành</th>
          <th class="table-header">Ngày Tạo</th>
          <th class="table-header">Ngày Cập Nhật</th>
          <th class="table-header action-column">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="district in districts" :key="district.iddistrict">
          <td class="table-body-cell">{{ district.iddistrict }}</td>
          <td class="table-body-cell">{{ district.district_name }}</td>
          <td class="table-body-cell">
            {{ getProvinceName(district.province_id) }}
          </td>
          <td class="table-body-cell">{{ district.created_at }}</td>
          <td class="table-body-cell">{{ district.updated_at }}</td>
          <td class="action-column">
            <button class="action-button" @click="updateDistrict(district.iddistrict)">Sửa</button>
            <button class="action-button" @click="deleteDistrict(district.iddistrict)">Xóa</button>
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
      districts: [],
    };
  },
  methods: {
    fetchDistricts() {
      axios.get('/api/districts') 
        .then(response => {
          this.districts = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    addDistrict() {
      axios.post('/api/districts', { district_name: 'New District' }) // Adjust data format
        .then(response => {
          console.log(response.data);
          this.fetchDistricts();
        })
        .catch(error => {
          console.error(error);
        });
    },
    updateDistrict(id) {
      axios.put(`/api/districts/${id}`, { district_name: 'Updated District' }) // Adjust data format
        .then(response => {
          console.log(response.data);
          this.fetchDistricts();
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteDistrict(id) {
      axios.delete(`/api/districts/${id}`)
        .then(response => {
          console.log(response.data.message);
          this.fetchDistricts();
        })
        .catch(error => {
          console.error(error);
        });
    },

    getProvinceName(provinceId) {
      return `Province Name (replace with actual name)`;
    },
  },
  mounted() {
    this.fetchDistricts();
  },
};
</script>

<style>
.district-table-container {
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

.add-district-button {
  margin: 20px 0; 
  padding: 10px 20px;
  background-color: #4CAF50; 
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.add-district-button:hover {
  background-color: #45a049; 
}
</style>