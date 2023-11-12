<template>
  <div class="w-[60em] max-h-[40em] overflow-y-auto px-2 rounded-lg p-4 bg-gray-300">
    <div class="my-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Company (Partner)</label>
      <select v-model="form.partner_id" class="px-2 py-4 mt-2 border-2 border-gray-400 rounded-lg outline-none">
        <option v-for="(partner, index) in partners.data" :key="index" :value="partner.id">
          {{ partner.name }}
        </option>
      </select>
    </div>
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Title</label>
      <input class="w-[40em] mt-2 p-4 border-2 border-gray-400 rounded-lg outline-none" v-model="form.job_title"
        type="text" name="name" placeholder="Job Name, e.x -  Automotive Mechanic" />
    </div>
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Remote Position</label>
      <input class="p-4 mt-2 border-2 rounded-md" v-model="form.is_remote" type="checkbox" name="remote_position" />
    </div>
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Category</label>
      <select v-model="form.category_id" class="px-2 py-4 mt-2 border-2 border-gray-400 rounded-lg outline-none">
        <option v-for="(category, index) in categories.data" :key="index" :value="category.id">
          {{ category.name }}
        </option>
      </select>
    </div>
    <div v-if="!form.is_remote">
      <div class="mb-4">
        <label class="block text-xs font-bold tracking-wide uppercase">City</label>
        <input class="w-[20em] mt-2 p-4 border-2 border-gray-400 rounded-lg outline-none" v-model="form.city" type="text"
          name="city" placeholder="City Name, e.x. - New York" />
      </div>
      <div class="mb-4">
        <label class="block text-xs font-bold tracking-wide uppercase">Country</label>
        <input class="w-[25em] mt-2 p-4 border-2 border-gray-400 rounded-lg outline-none" v-model="form.country"
          type="text" name="country" placeholder="Country Name, e.x. - United States" />
      </div>
    </div>
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">No Pay Range?</label>
      <input class="p-4 mt-2 border-2 border-gray-400 rounded-lg outline-none" v-model="form.no_pay_range" type="checkbox"
        name="no_pay_range" />
    </div>
    <div v-if="!form.no_pay_range" class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Salary Range</label>
      <div class="flex">
        <input class="w-[10em] mt-2 p-4 border-2 border-gray-400 rounded-lg outline-none" v-model="form.min_salary_range"
          type="number" name="min_salary_range" placeholder="Min. Salary" />
        <p class="flex items-center mx-4">to</p>
        <input class="w-[10em] mt-2 p-4 border-2 border-gray-400 rounded-lg outline-none" v-model="form.max_salary_range"
          type="number" name="max_salary_range" placeholder="Max. Salary" />
      </div>
    </div>
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Job Type</label>
      <select v-model="form.job_type_id" class="px-2 py-4 mt-2 border-2 border-gray-400 rounded-lg outline-none">
        <option v-for="(jobtype, index) in jobtypes.data" :key="index" :value="jobtype.id">
          {{ jobtype.name }}
        </option>
      </select>
    </div>
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Description</label>
      <textarea class="w-[35em] mt-2 block p-2.5 text-sm border-2 border-gray-400 rounded-lg outline-none"
        v-model="form.desc"></textarea>
    </div>
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Post Durations</label>
      <select v-model="form.job_active_duration" class="px-2 py-4 mt-2 border-2 border-gray-400 rounded-lg outline-none">
        <option v-for="(postduration, index) in postdurations.data" :key="index" :value="postduration.id">
          {{ postduration.name }}
        </option>
      </select>
    </div>
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Is Published?</label>
      <input class="p-4 mt-2 border-2 rounded-md" v-model="form.is_published" type="checkbox" name="published" />
    </div>
    <div class="mb-4">
      <label class="block text-xs font-bold tracking-wide uppercase">Status</label>
      <select v-model="form.status" class="px-2 py-4 mt-2 border-2 border-gray-400 rounded-lg outline-none">
        <option value="active">Active</option>
        <option value="paused">Paused</option>
      </select>
    </div>
    <Transition>
      <p v-show="showSuccessMsg" class="pt-4 font-bold text-teal-600 raleway-font">
        Job created successfully.
      </p>
    </Transition>
    <div class="flex justify-end mt-10">
      <a href="#!"
        class="w-24 p-4 m-4 text-sm font-bold text-center text-white uppercase bg-gray-400 rounded-lg outline-none hover:bg-teal-400"
        @click="submit">Create</a>
    </div>
  </div>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";
import postdurations from "../../../../store/modules/postdurations";

export default {
  data() {
    return {
      store: null,
      emptyFormState: {
        partner_id: null,
        job_title: null,
        is_remote: false,
        category_id: null,
        city: null,
        country: null,
        no_pay_range: false,
        min_salary_range: null,
        max_salary_range: null,
        job_type_id: null,
        desc: null,
        job_active_duration: null,
        is_published: false,
        expiration_date: null,
        status: null,
      },
      form: {
        partner_id: null,
        job_title: null,
        is_remote: false,
        category_id: null,
        city: null,
        country: null,
        no_pay_range: false,
        min_salary_range: null,
        max_salary_range: null,
        job_type_id: null,
        desc: null,
        job_active_duration: null,
        is_published: false,
        expiration_date: null,
        status: null,
      },
      showSuccessMsg: false,
    };
  },
  methods: {
    addMinutesToDate(noOfMinutes) {
      let date = new Date();
      date.setMinutes(date.getMinutes() + noOfMinutes);

      return date;
    },
    submit() {
      if (this.form.published) {
        let minutes;
        this.postdurations.data.forEach((item) => {
          if (item.id == this.form.job_active_duration) {
            minutes = item.duration;
            this.form.expiration = this.addMinutesToDate(minutes);
            this.$store.dispatch("jobs/new_job", this.form).then(() => {
              this.form = this.emptyFormState;
              this.showSuccessMsg = true;
            });
          }
        });
      } else {
        this.$store.dispatch("jobs/new_job", this.form).then(() => {
          this.form = this.emptyFormState;
          this.showSuccessMsg = true;
        });
      }
    },
  },
  setup() {
    const store = useStore();

    return {
      partners: computed(() => store.getters["partners/partners"]),
      categories: computed(() => store.getters["categories/categories"]),
      jobtypes: computed(() => store.getters["jobtypes/jobtypes"]),
      skills: computed(() => store.getters["skills/skills"]),
      postdurations: computed(
        () => store.getters["postdurations/postdurations"]
      ),
    };
  },
};
</script>
