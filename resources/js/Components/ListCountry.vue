<template>
  <div class="country-table-container">
    <h2>QUẢN LÝ QUỐC GIA</h2>
    <button class="addcountry-button" @click="openAddCountryModal">Thêm Quốc Gia Mới</button>

    <table class="country-table">
      <thead>
        <tr>
          <th class="table-header">ID</th>
          <th class="table-header">Tên Quốc Gia</th>
          <th class="table-header">Ngày Tạo</th>
          <th class="table-header">Ngày Cập Nhật</th>
          <th class="table-header action-column">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="country in countries" :key="country.idcountry">
          <td class="table-body-cell">{{ country.idcountry }}</td>
          <td class="table-body-cell">{{ country.country_name }}</td>
          <td class="table-body-cell">{{ country.created_at }}</td>
          <td class="table-body-cell">{{ country.updated_at }}</td>
          <td class="action-column">
            <button class="action-button" @click="updateCountry(country.idcountry)">Sửa</button>
            <button class="action-button" @click="deleteCountry(country.idcountry)">Xóa</button>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="addcountry-modal" v-if="showAddCountryModal">
      <div class="modal-content">
        <span class="close-button" @click="showAddCountryModal = false">&times;</span>
        <h2>Thêm Quốc Gia Mới</h2>
        <form @submit.prevent="addCountry">
          <div class="form-group">
            <label for="countryName">Tên Quốc Gia:</label>
            <input type="text" id="countryName" v-model="newCountryName" class="form-input" required>
          </div>
          <button type="submit" class="submit-button">Lưu</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      countries: [],
      showAddCountryModal: false,
      newCountryName: '',
    };
  },
  methods: {
    fetchCountries() {
      axios.get('/api/countries')
        .then(response => {
          this.countries = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    openAddCountryModal() {
      this.showAddCountryModal = true;
    },
    addCountry() {
      axios.post('/api/countries', { country_name: this.newCountryName })
        .then(response => {
          console.log(response.data);
          this.fetchCountries();
          this.showAddCountryModal = false; 
          this.newCountryName = ''; 
        })
        .catch(error => {
          console.error(error);
        });
    },
    updateCountry(id) {
      axios.put(`/api/countries/${id}`, { country_name: 'Updated Country' }) 
        .then(response => {
          console.log(response.data);
          this.fetchCountries();
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteCountry(id) {
      axios.delete(`/api/countries/${id}`)
        .then(response => {
          console.log(response.data.message);
          this.fetchCountries(); 
        })
        .catch(error => {
          console.error(error);
        });
    }
  },
  mounted() {
    this.fetchCountries(); 
  }
};
</script>

<style>
.country-table-container {
  margin: 40px auto;
  width: 80%;
  max-width: 1000px;
  border-collapse: collapse;
}

h2{
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

.addcountry-button {
  margin: 20px 0;
  padding: 10px 20px;
  background-color: #4CAF50; 
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.addcountry-button:hover {
  background-color: #45a049; 
}

.addcountry-modal {
  display: none; 
  position: fixed; 
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgba(0, 0, 0, 0.4); 
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto; 
  padding: 20px;
  border: 1px solid #888;
  width: 80%; 
}

.close-button {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close-button:hover,
.close-button:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.form-group {
  margin-bottom: 15px;
}

.form-label {
  display: block;
  margin-bottom: 5px;
}

.form-input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.submit-button {
  background-color: #4CAF50; 
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.submit-button:hover {
  background-color: #45a049; 
}
</style>