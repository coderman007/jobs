<template>
  <div class="text-right">
    <div class="w-full mt-8 mb-4 overflow-x-scroll text-left md:overflow-auto">
      <h2 class="mb-4 font-bold uppercase">Job Posts</h2>
      <div class="w-full border-2 border-gray-500 rounded-t-md">
        <Datatable :headers="tableHeaders" :data="jobs.data.slice(0,5)" :hideActions="true" />
      </div>    
    </div>
    <router-link to="/admin/jobs" class="font-thin text-gray-500 text-md">View All Jobs &gt;</router-link>
  </div>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";
import Datatable from "../../shared/datatable.vue"

export default {
  components: {
    Datatable
  },
  data() {
    return {
      tableHeaders: [
        { name: "Title", value: "title", isImage: false },
        { name: "Country", value: "country", isImage: false },
        {
          name: "Is Remote",
          value: "remote_position",
          isImage: false,
          isBoolean: true,
        },
        { name: "Expires on", value: "expiration", isImage: false },
        { name: "Status", value: "status", isImage: false },
      ],
    }
  },
  setup() {
    const store = useStore();
    
    return {
      getJobs: store.dispatch('jobs/index'),
      jobs: computed(() => store.getters["jobs/jobs"]),
    }
  }
}
</script>
