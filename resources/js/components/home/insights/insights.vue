<template>
  <div class="pt-2 md:pt-10">
    <h2 class="font-bold uppercase">Insights</h2>
    <div
      class="grid grid-cols-1 gap-4 px-4 py-4 mt-4 bg-gray-200 md:grid-cols-3 rounded-xl"
    >
      <InsightCard icon="/img/icons/jobs.svg" color="bg-teal-500" class="hover:bg-teal-600">
        <p>Total - <b>{{ (insights.jobs.total > 0) ? insights.jobs.total : 0 }}</b></p>
        <p>Posts this Week - <b>{{ (insights.jobs.this_week > 0) ? insights.jobs.this_week : 0 }}</b></p>
        <p>Change from Last Week - <b>{{ (insights.jobs.change_diff > 0) ? insights.jobs.change_diff : 0 }}%</b></p>
      </InsightCard>
      <InsightCard icon="/img/icons/users.svg" color="bg-blue-500" class="hover:bg-blue-600">
        <p>Applicants - <b>{{ (insights.applicants.total > 0) ? insights.applicants.total : 0 }}</b></p>
        <p>Selected Candidates this Month - <b>{{ (insights.applicants.selected_candidates > 0) ? insights.applicants.selected_candidates : 0 }}</b></p>
        <p>Change from Last Month - <b>{{ (insights.applicants.change_diff > 0) ? insights.applicants.change_diff : 0 }}%</b></p>
      </InsightCard>
      <InsightCard icon="/img/icons/partners.svg" color="bg-orange-500" class="hover:bg-orange-600">
        <p>Partners - <b>{{ (insights.partner.total > 0) ? insights.partner.total : 0 }}</b></p>
        <p>New Partners this Month - <b>{{ (insights.partner.new_partners > 0) ? insights.partner.new_partners : 0 }}</b></p>
        <p>Change from Last Month - <b>{{ (insights.partner.change_diff > 0) ? insights.partner.change_diff : 0 }}%</b></p>
      </InsightCard>
    </div>
  </div>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";
import InsightCard from "./insight-card.vue";

export default {
  components: {
    InsightCard,
  },
  data() {
    return {
      insights: []
    }
  },
  setup() {
    const store = useStore();

    return {
      getInsights: store.dispatch('dashboard/insights'),
      insights: computed(() => store.getters["dashboard/insights"]),
    };
  },
}
</script>
