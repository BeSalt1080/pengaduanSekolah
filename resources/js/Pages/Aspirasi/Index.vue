<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
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

const submit = () => {
  create.post(route("aspirasi.store"), {
    onFinish: () => create.reset(),
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
    <Head title="Woi" />
    <div class="w-5/6">
      <div class="flex justify-between">
        <h2
          class="font-semibold text-xl text-gray-800 leading-tight self-center"
        >
          Tabel Aspirasi
        </h2>
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
              <button class="btn btn-info" @click="openDetail(index)">
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
                <div class="modal-box" style="max-width: 64em !important">
                  <h3 class="font-bold text-lg">Aspirasi</h3>
                  <div class="flex justify-between">
                    <div class="w-1/2">
                        <h1 class="text-lg font-bold text-center">Aspirasi</h1>
                      <img
                        class="w-full"
                        :src="'/image/' + aspirasi.foto"
                        alt="waa"
                      />
                      <div>NIS: {{ aspirasi.nis }}</div>
                      <div>Kategori: {{ aspirasi.kategori.name }}</div>
                      <div>Lokasi: {{ aspirasi.lokasi }}</div>
                      <div>Keterangan: {{ aspirasi.keterangan }}</div>
                      <div>Status: {{ aspirasi.status }}</div>
                    </div>
                    <div class="w-1/2 ">
                        <h1 class="text-lg font-bold text-center">Tanggapan</h1>
                        <div class="flex justify-center h-full">
                            <Link :href="route('tanggapan.show',aspirasi.id)" class="btn btn-primary mt-32">Tambah Tanggapan</Link>
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
