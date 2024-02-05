<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const error = ref(false);

const form = useForm({
  nis: null,
  kategori_id: 0,
  lokasi: null,
  keterangan: null,
  foto: null,
});

const props = defineProps({
  kategoris: {
    type: Object,
    required: true,
  },
});

const submit = () => {
  form.post(route("aspirasi.store"), {
    onError: (errors) => {
      error.value(errors);
    },
  });
};
</script>

<template>
  <Head title="Welcome" />

  <div class="navbar bg-base-100 sticky top-0">
    <div class="flex-1">
      <a class="btn btn-ghost text-xl">Pengaduan Sekolah</a>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal px-1">
        <li><Link :href="route('login')">Login</Link></li>
      </ul>
    </div>
  </div>
  <div class="hero min-h-screen" style="background-image: url('/hero.jpg')">
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-center text-neutral-content">
      <div class="max-w-md">
        <h1 class="mb-5 text-5xl font-bold">
          Selamat Datang ke Pengaduan Sekolah
        </h1>
        <p class="mb-5">
          Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda
          excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a
          id nisi.
        </p>
        <!-- Open the modal using ID.showModal() method -->
        <button class="btn" onclick="my_modal_1.showModal()">
          Buat Pengaduan
        </button>
        <dialog id="my_modal_1" class="modal">
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
            <h3 class="font-bold text-lg text-accent-content">
              Buat Pengaduan
            </h3>
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
                <select
                  class="select select-bordered"
                  v-model="form.kategori_id"
                >
                  <option disabled selected value="0">Pilih Kategori</option>
                  <option
                    :value="kategori.id"
                    v-for="kategori in kategoris"
                    :key="kategori.id"
                  >
                    {{ kategori.name }}
                  </option>
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
        </dialog>
      </div>
    </div>
  </div>
</template>
