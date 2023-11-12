<template>
  <div class="w-[25em]">
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Name</label>
      <input class="w-full p-4 mt-2 border-2 border-gray-400 rounded-lg outline-none" v-model="form.name" type="text"
        name="name" placeholder="Category Name, e.x - Software Engineering" />
    </div>
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Icon</label>
      <div class="flex flex-row items-center justify-start">
        <div class="
                                    w-[11em]
                                    mt-4
                                    rounded-md
                                    flex flex-row
                                    px-4
                                    py-2
                                    bg-teal-400
                                    cursor-pointer
                                    shadow-md
                                  ">
          <input class="absolute opacity-0 cursor-pointer pin-x pin-y" type="file" name="cover_image"
            @change="onFileChange" />
          <img class="w-[15px]" src="/img/icons/upload.svg" />
          <p class="pl-2">Upload your file</p>
        </div>
        <p v-if="form.uploadedFile" class="w-48 mt-4 ml-2 text-sm italic truncate raleway-font">
          {{ form.uploadedFile.name }}
        </p>
      </div>
    </div>
    <Transition>
      <p v-show="showSuccessMsg" class="pt-4 font-bold text-teal-600 raleway-font">
        Category created successfully.
      </p>
    </Transition>
    <div class="flex justify-end mt-10">
      <a href="#!"
        class="w-24 px-4 py-2 text-sm font-bold text-center text-white uppercase bg-gray-400 border-2 border-gray-200 rounded-lg outline-none hover:text-gray-700 hover:bg-teal-400"
        @click="submit">Create</a>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      store: null,
      form: {
        name: "",
        uploadedFile: null,
      },
      showSuccessMsg: false,
    };
  },
  methods: {
    onFileChange(e) {
      let files = e.target.files;
      this.form.uploadedFile = files[0];
    },
    submit() {
      const _url = window.location.protocol + "//" + window.location.host;
      let data = { image: this.form.uploadedFile };
      let token = localStorage.getItem("auth_token");
      let api = axios.create({
        headers: { Authorization: `Bearer ${token}` },
      });

      api
        .post("/api/file/upload-image", data, {
          headers: {
            "Content-type": "multipart/form-data",
          },
        })
        .then((res) => {
          const uploadImg = res.data.data.file_name;

          this.$store.dispatch("categories/new_category", {
            name: this.form.name,
            icon: _url + '/img/uploads/' + uploadImg
          }).then(res => {
            this.form = {
              name: "",
              uploadedFile: null
            };
            this.showSuccessMsg = true;
          });
        });
    },
  },
};
</script>
