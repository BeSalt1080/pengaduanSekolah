<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const error = ref({});
const errorMessage = ref(null);
const success = ref(null);

const form = useForm({
  nis: null,
  kategori_id: null,
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
      error.value = errors;
      errorMessage.value = "Gagal membuat pengaduan";
      console.log(error.value);
      errorMessage.value = errors.warning;
      setTimeout(() => {
        errorMessage.value = null;
      }, 3000);
    },
    onSuccess: () => {
      form.reset();
      success.value = "Berhasil membuat pengaduan";
      setTimeout(() => {
        success.value = null;
      }, 3000);
    },
  });
};
</script>

<template >
  <Head title="Welcome" />
  <LandingLayout>
    <div
      class="hero min-h-[calc(100vh-68px)]"
      style="background-image: url('/hero.jpg')"
    >
      <div class="hero-overlay bg-opacity-60"></div>
      <div class="hero-content text-center text-neutral-content">
        <div class="max-w-md">
          <h1 class="mb-5 text-5xl font-bold">
            Selamat Datang ke Pengaduan Sekolah
          </h1>
          <p class="mb-5">
            Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda
            excepturi exercitationem quasi. In deleniti eaque aut repudiandae et
            a id nisi.
          </p>
          <!-- Open the modal using ID.showModal() method -->
          <button class="btn" onclick="my_modal_1.showModal()">
            Buat Pengaduan
          </button>
          <dialog id="my_modal_1" class="modal">
            <div class="toast" v-if="errorMessage != null">
              <div class="alert alert-error">
                <span>{{ errorMessage }}</span>
              </div>
            </div>
            <div class="toast" v-if="success != null">
              <div class="alert alert-success">
                <span>{{ success }}</span>
              </div>
            </div>
            <div class="modal-box text-primary-content">
              <h3 class="font-bold text-lg text-accent-content">
                Buat Pengaduan
              </h3>
              <form @submit.prevent="submit">
                {{ error.foto }}
                <label class="form-control">
                  <div class="label">
                    <span class="label-text">Foto</span>
                  </div>
                  <input
                    :class="{ 'input-error': error.foto }"
                    type="file"
                    class="file-input file-input-bordered file-input-primary w-full"
                    @input="
                      (e) => {
                        form.foto = e.target.files[0];
                      }
                    "
                    accept="image/*"
                  />
                  <div class="label">
                    <span
                      class="label-text text-error"
                      :class="{ hidden: !error.foto }"
                    >
                      {{ error.foto }}
                    </span>
                  </div>
                </label>
                <label class="form-control w-full">
                  <div class="label">
                    <span class="label-text">NIS (10)</span>
                  </div>
                  <input
                    :class="{ 'input-error': error.nis }"
                    type="text"
                    v-model="form.nis"
                    placeholder="Masukkan NIS anda..."
                    class="input input-bordered w-full"
                    maxlength="10"
                  />
                  <div class="label">
                    <span
                      class="label-text text-error"
                      :class="{ hidden: !error.nis }"
                    >
                      {{ error.nis }}
                    </span>
                  </div>
                </label>
                <label class="form-control w-full">
                  <div class="label">
                    <span class="label-text">Kategori</span>
                  </div>
                  <select
                    :class="{ 'select-error': error.kategori_id }"
                    class="select select-bordered"
                    v-model="form.kategori_id"
                  >
                    <option disabled selected value="null">
                      Pilih Kategori
                    </option>
                    <option
                      :value="kategori.id"
                      v-for="kategori in kategoris"
                      :key="kategori.id"
                    >
                      {{ kategori.name }}
                    </option>
                  </select>
                  <div class="label">
                    <span
                      class="label-text text-error"
                      :class="{ hidden: !error.kategori_id }"
                    >
                      {{ error.kategori_id }}
                    </span>
                  </div>
                </label>
                <label class="form-control">
                  <div class="label">
                    <span class="label-text">Lokasi</span>
                  </div>
                  <input
                    :class="{ 'input-error': error.lokasi }"
                    type="text"
                    placeholder="Masukkan lokasi laporan"
                    class="input input-bordered w-full"
                    v-model="form.lokasi"
                  />
                  <div class="label">
                    <span
                      class="label-text text-error"
                      :class="{ hidden: !error.lokasi }"
                    >
                      {{ error.lokasi }}
                    </span>
                  </div>
                </label>
                <label class="form-control">
                  <div class="label">
                    <span class="label-text">Keterangan</span>
                  </div>
                  <textarea
                    :class="{ 'textarea-error': error.keterangan }"
                    class="textarea textarea-bordered h-24"
                    placeholder="Keterangan laporan"
                    v-model="form.keterangan"
                  ></textarea>
                  <div class="label">
                    <span
                      class="label-text text-error"
                      :class="{ hidden: !error.keterangan }"
                    >
                      {{ error.keterangan }}
                    </span>
                  </div>
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
    <div id="profile" class="hero min-h-screen bg-base-200">
      <div class="hero-content flex-col lg:flex-row-reverse">
        <img
          src="https://assets-a1.kompasiana.com/items/album/2022/10/14/lapangan-outdoor-6349446160e28e1da566c552.jpg"
          class="w-1/2 rounded-lg shadow-2xl"
        />
        <div class="w-1/2">
          <h1 class="text-5xl font-bold">Sekolah Cinta Kasih Tzu Chi</h1>
          <p class="py-6">
            bertujuan mengembangkan kemampuan setiap siswa, baik dari segi pemikiran (mind), jasmani (body), kecerdasan (intelligence), serta kepekaan terhadap kemampuan mengapresiasi nilai kemanusiaan, kehidupan alam sekitar, spiritualitas dan seni. Pola Pendidikan kami dalam mengembangkan kebebasan berfikir secara kritis dan benar serta keputusan untuk memilih dan menjadi ahli dalam kehidupannya akan berlandaskan kepada perilaku budaya Humanis.
          </p>
        </div>
      </div>
    </div>
  </LandingLayout>
</template>
