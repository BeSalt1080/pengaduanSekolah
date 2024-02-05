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

const create = useForm({
  status: null,
  feedback: null,
  aspirasi_id: null,
});

const submit = () => {
  create.post(route("siswa.store"), {
    onFinish: () => create.reset("kelas", "nis"),
  });
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Woi" />
    <div
      role="alert"
      class="absolute top-20 max-w-sm right-2 alert alert-error"
      v-if="error"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="stroke-current shrink-0 h-6 w-6"
        fill="none"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
        />
      </svg>
      <span>Error! Task failed successfully.</span>
    </div>
    <div class="modal-box text-primary-content">
      <h3 class="font-bold text-lg text-accent-content">Buat Pengaduan</h3>
      <form @submit.prevent="submit">
        <label class="form-control">
          <div class="label">
            <span class="label-text">Foto</span>
          </div>
          <input
            type="file"
            class="file-input file-input-bordered file-input-primary w-full"
            @input="
              (e) => {
                form.foto = e.target.files[0];
              }
            "
            accept="image/*"
          />
        </label>
        <label class="form-control w-full">
          <div class="label">
            <span class="label-text">NIS</span>
          </div>
          <input
            type="text"
            v-model="form.nis"
            placeholder="Masukkan NIS anda..."
            class="input input-bordered w-full"
          />
        </label>
        <label class="form-control w-full">
          <div class="label">
            <span class="label-text">Kategori</span>
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
            <span class="label-text">Lokasi</span>
          </div>
          <input
            type="text"
            placeholder="Masukkan lokasi laporan"
            class="input input-bordered w-full"
            v-model="form.lokasi"
          />
        </label>
        <label class="form-control">
          <div class="label">
            <span class="label-text">Keterangan</span>
          </div>
          <textarea
            class="textarea textarea-bordered h-24"
            placeholder="Keterangan laporan"
            v-model="form.keterangan"
          ></textarea>
        </label>
        <div class="modal-action">
          <button class="btn btn-primary">Submit</button>
          <form method="dialog">
            <button class="btn">Close</button>
          </form>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
