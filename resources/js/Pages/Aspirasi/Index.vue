<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const deletes = ref([]);
const tanggapanDeletes = ref([]);
const tanggapanEdits = ref([]);
const details = ref([]);
const edits = ref([]);

const create = useForm({
  aspirasi_id: 0,
  feedback: null,
});

const edit = useForm({
    _method: 'PUT',
  aspirasi_id: 0,
  feedback: null,
});

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

const removeTanggapan = (id) => {
  router.visit(route("tanggapan.destroy", id), {
    onFinish: () => "",
    method: "delete",
  });
};

const editTanggapan = (id) => {
  edit.post(route("tanggapan.update", id), {
    onFinish: () => "",
    method: "put",
  });
};

const store = (id) => {
  create.aspirasi_id = id;
  create.post(route("tanggapan.store"), {
    onFinish: () => create.reset("status", "feedback"),
  });
};

const openDelete = (index) => {
  deletes.value[index].showModal();
};

const openDetail = (index) => {
  details.value[index].showModal();
};

const openEdit = (index, status, feedback, aspirasi_id) => {
  edit.status = status;
  edit.feedback = feedback;
  edit.aspirasi_id = aspirasi_id
  edits.value[index].showModal();
};

const openDeleteTanggapan = (index) => {
  tanggapanDeletes.value[index].showModal();
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
                      <h1 class="text-2xl font-bold text-center pb-5">
                        Aspirasi
                      </h1>
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
                    <div
                      class="divider-horizontal divider-primary divider"
                    ></div>
                    <div class="w-1/2 h-full">
                      <h1 class="text-2xl font-bold text-center">Tanggapan</h1>
                      <div class="flex justify-center">
                        <div
                          v-if="aspirasi.tanggapan !== null"
                          class="p-3 w-full"
                        >
                          <h1 class="text-xl">Feedback :</h1>
                          <template
                            v-for="(tanggapan, index) in aspirasi.tanggapan"
                            :key="index"
                          >
                            <div
                              class="border p-5 rounded-lg shadow-md bg-base-200 flex w-full"
                            >
                              <div
                                class="text-lg flex justify-between w-full content-center"
                              >
                                <div class="">{{ tanggapan.feedback }}</div>
                                <div>
                                  <button
                                    class="btn btn-warning text-xl"
                                    @click="openEdit(index, tanggapan.status, tanggapan.feedback, tanggapan.aspirasi_id)"
                                  >
                                    
                                  </button>
                                  <dialog
                                    :ref="
                                      (el) => {
                                        edits.push(el);
                                      }
                                    "
                                    class="modal"
                                  >
                                    <div class="modal-box">
                                      <form
                                        @submit.prevent="editTanggapan(tanggapan.id)"
                                        class="flex flex-col"
                                      >
                                        <h3 class="font-bold text-lg">
                                          Edit Tanggapan
                                        </h3>
                                        <label class="form-control">
                                          <div class="label">
                                            <span class="label-text"
                                              >Feedback</span
                                            >
                                          </div>
                                          <textarea
                                            class="textarea textarea-bordered h-24"
                                            placeholder="Feedback laporan"
                                            v-model="edit.feedback"
                                          ></textarea>
                                        </label>
                                        <div class="modal-action">
                                          <button class="btn btn-primary">
                                            Submit
                                          </button>
                                          <form method="dialog">
                                            <!-- if there is a button in form, it will close the modal -->
                                            <button class="btn">Close</button>
                                          </form>
                                        </div>
                                      </form>
                                    </div>
                                  </dialog>
                                  <button
                                    class="btn btn-error text-xl"
                                    @click="openDeleteTanggapan(index)"
                                  >
                                    
                                  </button>
                                  <dialog
                                    :ref="
                                      (el) => {
                                        tanggapanDeletes.push(el);
                                      }
                                    "
                                    class="modal"
                                  >
                                    <div class="modal-box">
                                      <h3 class="font-bold text-lg">
                                        Delete Tanggapan
                                      </h3>
                                      <label class="form-control w-full">
                                        <div class="label">
                                          <span class="label-text"
                                            >Apakah anda yakin?</span
                                          >
                                        </div>
                                      </label>
                                      <div class="modal-action">
                                        <button
                                          class="btn btn-error"
                                          @click="removeTanggapan(tanggapan.id)"
                                        >
                                          Hapus
                                        </button>
                                        <form method="dialog">
                                          <!-- if there is a button in form, it will close the modal -->
                                          <button class="btn">Close</button>
                                        </form>
                                      </div>
                                    </div>
                                  </dialog>
                                </div>
                              </div>
                            </div>
                            <div>
                                <div>
                                    Status: <template v-if="index == 0">Proses</template> <template v-else>Selesai</template>
                                </div>
                                <div>
                                    Waktu Pembuatan :
                                    {{ new Date(Date.parse(tanggapan.created_at)) }}
                                </div>
                            </div>
                          </template>
                        </div>
                        <div v-else class="p-3">Belum ada tanggapan</div>
                      </div>
                      <div class="" v-if="aspirasi.tanggapan.length < 2">
                        <form
                          @submit.prevent="store(aspirasi.id)"
                          class="w-full flex"
                        >
                          <label class="form-control">
                            <input
                              class="input input-bordered"
                              placeholder="Feedback laporan"
                              v-model="create.feedback"
                            />
                          </label>
                          <button class="btn"></button>
                        </form>
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
