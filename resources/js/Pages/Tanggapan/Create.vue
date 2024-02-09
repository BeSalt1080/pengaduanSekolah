<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
  aspirasi: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  status: 0,
  feedback: null,
  aspirasi_id: props.aspirasi.id,
});

const submit = () => {
  form.post(route("tanggapan.store"), {
    onFinish: () => form.reset("status","feedback"),
  });
};

</script>
<template>
  <AuthenticatedLayout>
    <Head title="Woi" />
    <div class="modal-box text-primary-content">
      <h3 class="font-bold text-lg text-accent-content">Buat Tanggapan</h3>
      <form @submit.prevent="submit">
        <label class="form-control w-full">
          <div class="label">
            <span class="label-text">Status</span>
          </div>
          <select class="select select-bordered" v-model="form.status">
            <option disabled selected value="0">Pilih Status</option>
            <option value="Menunggu">Menunggu</option>
            <option value="Proses">Proses</option>
            <option value="Selesai">Selesai</option>
          </select>
        </label>
        <label class="form-control">
          <div class="label">
            <span class="label-text">Feedback</span>
          </div>
          <textarea
            class="textarea textarea-bordered h-24"
            placeholder="Feedback laporan"
            v-model="form.feedback"
          ></textarea>
        </label>
        <div class="modal-action">
          <button class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
