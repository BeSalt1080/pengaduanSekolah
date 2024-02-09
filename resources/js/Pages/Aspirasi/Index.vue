<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

const deletes = ref([]);
const details = ref([]);
const props = defineProps({
  aspirasis: {
    type: Object,
    required: true,
  },
});

const remove = (id) => {
  router.visit(route("aspirasi.destroy", id), {
    onFinish: () => "",
    method: "delete",
  });
};

const openDelete = (index) => {
  deletes.value[index].showModal();
};
const openDetail = (index) => {
  details.value[index].showModal();
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Aspirasi" />
    <div class="w-5/6 bg-white p-5 rounded-xl">
      <div class="flex justify-between">
        <h2
          class="font-semibold text-xl text-gray-800 leading-tight self-center"
        >
          Tabel Aspirasi
        </h2>
        <a :href="route('download')" class="btn btn-primary"
          >Download Laporan</a
        >
      </div>
      <table class="table w-full table-fixed">
        <thead>
          <tr>
            <th>Foto</th>
            <th>NIS</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="7" class="text-center" v-if="aspirasis.length == 0">
              Belum ada aspirasi
            </td>
          </tr>
          <tr v-for="(aspirasi, index) in aspirasis" :key="aspirasi.id">
            <td>
              <img class="w-full" :src="'/image/' + aspirasi.foto" alt="waa" />
            </td>
            <td>{{ aspirasi.nis }}</td>
            <td>{{ aspirasi.kategori.name }}</td>
            <td>{{ aspirasi.lokasi }}</td>
            <td>{{ aspirasi.keterangan }}</td>
            <td>{{ aspirasi.status }}</td>
            <td>
              <button class="btn btn-info me-2" @click="openDetail(index)">
                Show
              </button>
              <dialog
                :ref="
                  (el) => {
                    details.push(el);
                  }
                "
                class="modal w-screen"
              >
                <div class="modal-box p-10" style="max-width: 64em !important">
                  <div class="flex justify-between gap-5 w-full">
                    <div class="w-1/2">
                      <h1 class="text-2xl font-bold text-center pb-5">Aspirasi</h1>
                      <img
                        class="w-full"
                        :src="'/image/' + aspirasi.foto"
                        alt="waa"
                      />
                      <table class="text-lg">
                        <tr class="border-0">
                          <td class="py-2 px-5 font-bold">
                            <i class="fa-solid fa-square text-xs text-primary"
                              >></i
                            >
                            NIS
                          </td>
                          <td class="px-5">
                            {{ aspirasi.nis }}
                          </td>
                        </tr>
                        <tr class="border-0">
                          <td class="py-2 px-5 font-bold">
                            <i class="fa-solid fa-square text-xs text-primary"
                              >></i
                            >
                            Kategori
                          </td>
                          <td class="px-5">
                            {{ aspirasi.kategori.name }}
                          </td>
                        </tr>
                        <tr class="border-0">
                          <td class="py-2 px-5 font-bold">
                            <i class="fa-solid fa-square text-xs text-primary"
                              >></i
                            >
                            Lokasi
                          </td>
                          <td class="px-5">
                            {{ aspirasi.lokasi }}
                          </td>
                        </tr>
                        <tr class="border-0">
                          <td class="py-2 px-5 font-bold">
                            <i class="fa-solid fa-square text-xs text-primary"
                              >></i
                            >
                            Keterangan
                          </td>
                          <td class="px-5">
                            {{ aspirasi.keterangan }}
                          </td>
                        </tr>
                        <tr class="border-0">
                          <td class="py-2 px-5 font-bold">
                            <i class="fa-solid fa-square text-xs text-primary"
                              >></i
                            >Status
                          </td>
                          <td class="px-5">
                            {{ aspirasi.status }}
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="divider-horizontal divider-primary divider"></div>
                    <div class="w-1/2">
                      <h1 class="text-2xl font-bold text-center">Tanggapan</h1>
                      <div class="flex justify-center h-full">
                        <div v-if="aspirasi.tanggapan" class="p-3">
                            <h1 class="text-xl">Feedback :</h1>
                          <div class="border p-5 rounded-lg shadow-md bg-base-200">
                            <span class="text-lg">{{
                              aspirasi.tanggapan.feedback
                            }}</span>
                          </div>
                          <div>
                            Waktu Pembuatan :
                            {{ Date(aspirasi.tanggapan.created_at) }}
                          </div>
                        </div>
                        <Link
                          :href="route('tanggapan.show', aspirasi.id)"
                          class="btn btn-primary mt-24"
                          v-else
                          >Tambah Tanggapan</Link
                        >
                      </div>
                    </div>
                  </div>
                  <div class="modal-action">
                    <form method="dialog">
                      <button class="btn">Close</button>
                    </form>
                  </div>
                </div>
              </dialog>
              <button class="btn btn-error" @click="openDelete(index)">
                Delete
              </button>
              <dialog
                :ref="
                  (el) => {
                    deletes.push(el);
                  }
                "
                class="modal"
              >
                <div class="modal-box">
                  <h3 class="font-bold text-lg">Delete Aspirasi</h3>
                  <label class="form-control w-full">
                    <div class="label">
                      <span class="label-text">Apakah anda yakin?</span>
                    </div>
                  </label>
                  <div class="modal-action">
                    <button class="btn btn-error" @click="remove(aspirasi.id)">
                      Hapus
                    </button>
                    <form method="dialog">
                      <!-- if there is a button in form, it will close the modal -->
                      <button class="btn">Close</button>
                    </form>
                  </div>
                </div>
              </dialog>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AuthenticatedLayout>
</template>
