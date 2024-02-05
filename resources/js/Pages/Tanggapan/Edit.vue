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
    onFinish: () => create.reset('kelas','nis'),
  });
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Woi" />
    <div class="w-1/2">
      <div class="flex justify-between">
        <h2
          class="font-semibold text-xl text-gray-800 leading-tight self-center"
        >
          Tabel Siswa
        </h2>
        <div class="self-center">
          <button class="btn btn-primary" onclick="tambah.showModal()">
            Tambah Siswa
          </button>
          <dialog id="tambah" class="modal">
            <div class="modal-box">
              <form @submit.prevent="submit">
                <h3 class="font-bold text-lg">Tambah Siswa</h3>
                <label class="form-control w-full">
                  <div class="label">
                    <span class="label-text">Nis (max 10)</span>
                  </div>
                  <input
                    type="text"
                    placeholder="Nis... "
                    class="input input-bordered w-full"
                    v-model="create.nis"
                  />
                </label>
                <label class="form-control w-full">
                  <div class="label">
                    <span class="label-text">Kelas</span>
                  </div>
                  <input
                    type="text"
                    placeholder="Kelas... "
                    class="input input-bordered w-full"
                    v-model="create.kelas"
                  />
                </label>
                <div class="modal-action">
                  <button class="btn btn-primary">Tambah</button>
                  <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn">Close</button>
                  </form>
                </div>
              </form>
            </div>
          </dialog>
        </div>
      </div>
      <table class="table w-full table-fixed">
        <!-- head -->
        <thead>
          <tr>
            <th>No</th>
            <th>Nis</th>
            <th>Kelas</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->
          <tr>
            <td colspan="3" class="text-center" v-if="!siswa">
              Belum ada siswa
            </td>
          </tr>
          <tr v-for="(siswa, index) in siswa" :key="siswa.id">
            <th>{{ index + 1 }}</th>
            <td>{{ siswa.nis }}</td>
            <td>{{ siswa.kelas }}</td>
            <td>
              <button class="btn btn-warning" @click="openEdit(index)">
                Edit
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
                  <form @submit.prevent="update(siswa.id)">
                    <h3 class="font-bold text-lg">Edit Siswa</h3>
                    <label class="form-control w-full">
                      <div class="label">
                        <span class="label-text">Nis (max 10)</span>
                      </div>
                      <input
                        type="text"
                        placeholder="Nis... "
                        class="input input-bordered w-full"
                        v-model="edit.nis"
                      />
                    </label>
                    <label class="form-control w-full">
                      <div class="label">
                        <span class="label-text">Kelas</span>
                      </div>
                      <input
                        type="text"
                        placeholder="Kelas... "
                        class="input input-bordered w-full"
                        v-model="edit.kelas"
                      />
                    </label>
                    <div class="modal-action">
                      <button class="btn btn-warning">Edit</button>
                      <form method="dialog">
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn">Close</button>
                      </form>
                    </div>
                  </form>
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
                  <h3 class="font-bold text-lg">Delete Siswa</h3>
                  <label class="form-control w-full">
                    <div class="label">
                      <span class="label-text">Apakah anda yakin?</span>
                    </div>
                  </label>
                  <div class="modal-action">
                    <button class="btn btn-error" @click="remove(siswa.id)">
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
