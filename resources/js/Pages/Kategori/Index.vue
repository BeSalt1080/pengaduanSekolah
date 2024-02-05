<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const edits = ref([]);
const deletes = ref([]);
const props = defineProps({
  kategoris: {
    type: Object,
    required: true,
  },
});

const create = useForm({
  name: null,
});

const edit = useForm({
  name: "",
  _method: "PUT",
});

const update = (id) => {
  edit.post(route("kategori.update", id), {
    onFinish: () => edit.reset(),
  });
};

const remove = (id) => {
  router.visit(route("kategori.destroy", id), {
    onFinish: () => "",
    method: "delete",
  });
};

const submit = () => {
  create.post(route("kategori.store"), {
    onFinish: () => create.reset(),
  });
};

const openEdit = (index) => {
  edits.value[index].showModal();
  edit.name = props.kategoris[index].name;
};

const openDelete = (index) => {
  deletes.value[index].showModal();
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Woi" />
    <div class="w-1/3">
      <div class="flex justify-between">
        <h2
          class="font-semibold text-xl text-gray-800 leading-tight self-center"
        >
          Tabel Kategori
        </h2>
        <div class="self-center">
          <button class="btn btn-primary" onclick="tambah.showModal()">
            Tambah Kategori
          </button>
          <dialog id="tambah" class="modal">
            <div class="modal-box">
              <form @submit.prevent="submit">
                <h3 class="font-bold text-lg">Tambah Kategori</h3>
                <label class="form-control w-full">
                  <div class="label">
                    <span class="label-text">Nama Kategori</span>
                  </div>
                  <input
                    type="text"
                    placeholder="Kategori... "
                    class="input input-bordered w-full"
                    v-model="create.name"
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
            <th>Nama Kategori</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->
          <tr>
            <td colspan="3" class="text-center" v-if="kategoris.length == 0">
              Belum ada kategori
            </td>
          </tr>
          <tr v-for="(kategori, index) in kategoris" :key="kategori.id">
            <th>{{ index + 1 }}</th>
            <td>{{ kategori.name }}</td>
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
                  <form @submit.prevent="update(kategori.id)">
                    <h3 class="font-bold text-lg">Edit Kategori</h3>
                    <label class="form-control w-full">
                      <div class="label">
                        <span class="label-text">Nama Kategori</span>
                      </div>
                      <input
                        type="text"
                        placeholder="Kategori... "
                        class="input input-bordered w-full"
                        v-model="edit.name"
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
                  <h3 class="font-bold text-lg">Delete Kategori</h3>
                  <label class="form-control w-full">
                    <div class="label">
                      <span class="label-text">Apakah anda yakin?</span>
                    </div>
                  </label>
                  <div class="modal-action">
                    <button class="btn btn-error" @click="remove(kategori.id)">
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
