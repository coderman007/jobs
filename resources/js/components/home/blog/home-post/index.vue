<template>
  <div class="w-full mt-8">
    <div class="flex justify-between w-full">
      <h2 class="mb-4 font-bold uppercase">Blog Posts</h2>
    </div>
    <div v-if="posts.data">
      <div v-if="posts.data[0]">
        <Post :img="posts.data[0].featured_image" :name="posts.data[0].title" :date="posts.data[0].published_date"   />
      </div>
      <div v-if="posts.data[1]">
        <Post :img="posts.data[1].featured_image" :name="posts.data[1].title" :date="posts.data[1].published_date"   />
      </div>
      <div v-if="posts.data[2]">
        <Post :img="posts.data[2].featured_image" :name="posts.data[2].title" :date="posts.data[2].published_date"   />
      </div>
    </div>
    <router-link to="/admin/content-management" class="font-semibold text-gray-700 hover:text-blue-700 text-md">View All Posts &gt;</router-link>
  </div>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';
import Post from './post.vue'

export default {
  components: {
    Post
  },
  setup() {
    const store = useStore();

    return {
      getPosts: store.dispatch('blog/index'),
      posts: computed(() => store.getters["blog/posts"]),
    };
  },
}
</script>
