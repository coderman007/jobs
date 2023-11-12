<template>
  <div
    class="flex flex-col content-between w-full max-w-sm p-6 mx-auto mt-4 bg-white border border-black rounded-md  md:mr-6">
    <div class="flex flex-col">
      <img :src="img" class="object-cover w-full h-48 mb-2 rounded-lg" />
      <a href="#!">
        <h4 class="max-w-[10em] truncate font-normal text-2xl mb-2">{{ title }}</h4>
      </a>
      <p class="text-base text-gray-600">
        {{ excerpt }}
      </p>
      <div class="flex flex-row justify-between mt-16">
        <div>
          <router-link :to="`/admin/content-management/blog/post/${id}`" class="text-base text-black">Edit
            Post</router-link>
          <a href="#!" @click.prevent="togglePublishedStatus(id)" class="ml-4 text-base text-gray-400">{{ (published) ?
            'Hide Post' : 'Show Post' }}</a>
        </div>
        <div>
          <a href="#!" @click.prevent="deletePost(id)"><font-awesome-icon :icon="['fas', 'trash']" /></a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: Number,
    img: String,
    title: String,
    excerpt: String,
    status: { type: Boolean, required: true },
    deletePost: Function,
  },
  data() {
    return {
      published: false,
    }
  },
  mounted() {
    this.published = this.status;
  },
  methods: {
    togglePublishedStatus(id) {
      let token = localStorage.getItem("auth_token");
      let Api = token
        ? axios.create({
          headers: { Authorization: `Bearer ${token}` },
        })
        : axios.create();

      Api.get('/api/admin/blogposts/toggle-public/' + id)
        .then(response => {
          this.published = response.data.data.is_published;
        });
    }
  }
}
</script>