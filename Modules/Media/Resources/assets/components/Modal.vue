<template>
  <div class="modal">
    <div v-if="failSendingImage" class="error-sending-image">Gagal menambahkan gambar</div>
    <form @submit="formSubmit" enctype="multipart/form-data">
      <!-- <div class="form-group">
        <label for="">Image Name</label>
        <input type="text" class="form-control" name="image-name">
      </div> -->
      <div class="form-body">
        <input type="file" class="input-file" id="image" name="image" v-on:change="onFileChange" ref="file" multiple>
        <span>Put your image here</span>
      </div>
      <div class="form-preview">
        <div class="form-preview-body-image">
          <div class="form-preview-body-image-image" v-for="(u, index) in url" :key="`u-${index}`">
            <img :src="u" style="height: 50px; padding: 0 25px;" />
          </div>
        </div>
        <div class="form-preview-body-name">
          <div class="form-preview-body-name-name" v-for="(f, index) in file" :key="`f-${index}`">
            <p>{{ f.name }}</p>
          </div>
        </div>
      </div>
      <button class="add-button">Add</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Modal",
  data() {
    return {
      file: [],
      url: [],
      kotak: [],
      imageName: "",
      failSendingImage: false,
    };
  },
  methods: {
    onFileChange(e) {
      // console.log(e.target.files[1]);
      let i = 0;
      for (i = 0; i < e.target.files.length; i++) {
        // console.log(e.target.files[i]);
        this.file.push(e.target.files[i]);
        this.url.push(URL.createObjectURL(e.target.files[i]));
        // console.log(this.file);
        // console.log(this.url);
      }

      console.log(this.file);
      console.log(this.url);

      // this.file = e.target.files;
      // console.log(this.file);
      // console.log(e.target.files[0].name);
      // this.file = e.target.files[0];
      // this.imageName = e.target.files[0].name;
      // this.kotak = [...this.file];
      // console.log(this.kotak);
      // this.url = URL.createObjectURL(this.file);
    },
    testBind() {
      this.$emit("update");
    },
    uploadImages() {
      const promises = Array.from(this.file).map((f) => {
        const config = {
          headers: { "content-type": "multipart/form-data" },
        };
        let formData = new FormData();
        formData.append("file", f);
        return axios
          .post("http://127.0.0.1:8000/media/addmedia", formData, config)
          .then(function(response) {
            console.log(response);
          })
          .catch((err) => (this.failSendingImage = true));
      });
      return Promise.all(promises);
    },
    async formSubmit(e) {
      e.preventDefault();

      await this.uploadImages();

      await this.testBind();
      // console.log(this.file[0]);
      // const config = {
      //   headers: { "content-type": "multipart/form-data" },
      // };
      // let formData = new FormData();
      // formData.append("file", this.file[i]);
      // console.log(this.file[i]);
      // axios
      //   .post("http://127.0.0.1:8000/panel/addmedia", formData, config)
      //   .then(function(response) {
      //     console.log(response);
      //   });

      // axios
      //   .post("http://127.0.0.1:8000/panel/addmedia", formData, config)
      //   .then(function(response) {
      //     console.log(response);
      //   });
      // .then(() => this.testBind())
      // .catch(function(error) {
      //   currentObj.output = error;
      // });
    },
  },
};
</script>

<style scoped>
.modal {
  top: 10%;
  bottom: 10%;
  right: 10%;
  left: 10%;
  position: absolute;
  background: #f5f5f5;
  min-height: 300px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.error-sending-image {
  position: absolute;
  background-color: lawngreen;
  z-index: 5;
  opacity: 0.9;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

form {
  width: 100%;
  height: 100%;
  background-color: #f5f5f5;
  position: absolute;
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-direction: column;
}

.form-body {
  height: 20%;
  width: 80%;
  background-color: white;
  position: relative;
  cursor: pointer;
  margin: 3rem auto;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px dotted black;
}

.form-body:hover {
  background-color: #f5f5f5;
}

.form-preview {
  min-height: 30%;
  min-width: 80%;
  background-color: white;
  display: flex;
  overflow-y: scroll;
}

.form-preview-body-image {
  display: flex;
  flex: 1 1 0;
  flex-direction: column;
}

.form-preview-body-name {
  display: flex;
  flex: 1 1 0;
  flex-direction: column;
}

.form-preview-body-image-image {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0.2rem 0;
  height: 50px;
}

.form-preview-body-name-name {
  min-height: 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0.2rem 0;
}

input {
  width: 100%;
  height: 100%;
  position: absolute;
  cursor: pointer;
  opacity: 0;
}

.add-button {
  margin: 2rem auto;
}
</style>
