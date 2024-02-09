<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
  aspirasis: {
    type: Object,
    required: true,
  },
  query: {
    type: String,
  },
});
</script>
<template>
    <Head title="Search"/>
  <LandingLayout>
    <div id="profile" class="min-h-screen flex flex-col">
      <h1 class="text-center font-bold text-2xl mt-10 mb-5">Pencarian Aspirasi</h1>
      <div class="m-5 border bg-white rounded-xl">
        <div class="flex justify-between px-16 my-5">
          <h2 class="text-xl" v-if="query">
            Anda mencari: <span class="font-bold">{{ query }}</span>
          </h2>
          <form :action="route('search')" method="get">
            <input
              name="q"
              type="search"
              placeholder="Cari Pengaduan…"
              autocomplete="off"
              spellcheck="false"
              class="input input-bordered w-full h-9 input-primary"
            />
            <button></button>
          </form>
        </div>
        <div class="px-16">
          <table class="table w-full table-fixed text-lg">
            <thead>
              <tr>
                <th>Foto</th>
                <th>
                  <div class="flex gap-3 place-items-center">
                    NIS
                    <a href="#"
                      ><svg
                        class="w-3 h-3 ms-1.5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"
                        /></svg
                    ></a>
                  </div>
                </th>
                <th>
                  <div class="flex gap-3 place-items-center">
                    Kategori
                    <a href="#"
                      ><svg
                        class="w-3 h-3 ms-1.5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"
                        /></svg
                    ></a>
                  </div>
                </th>
                <th>
                  <div class="flex gap-3 place-items-center">
                    Lokasi
                    <a href="#"
                      ><svg
                        class="w-3 h-3 ms-1.5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"
                        /></svg
                    ></a>
                  </div>
                </th>
                <th>
                  <div class="flex gap-3 place-items-center">
                    Keterangan
                    <a href="#"
                      ><svg
                        class="w-3 h-3 ms-1.5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"
                        /></svg
                    ></a>
                  </div>
                </th>
                <th>
                  <div class="flex gap-3 place-items-center">
                    Status
                    <a href="#"
                      ><svg
                        class="w-3 h-3 ms-1.5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"
                        /></svg
                    ></a>
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td
                  colspan="6"
                  class="text-center"
                  v-if="aspirasis.data.length == 0"
                >
                  Belum ada aspirasi
                </td>
              </tr>
              <tr v-for="aspirasi in aspirasis.data" :key="aspirasi.id">
                <td>
                  <img
                    class="w-full"
                    :src="'/image/' + aspirasi.foto"
                    alt="waa"
                  />
                </td>
                <td>{{ aspirasi.nis }}</td>
                <td>{{ aspirasi.kategori.name }}</td>
                <td>{{ aspirasi.lokasi }}</td>
                <td>{{ aspirasi.keterangan }}</td>
                <td>{{ aspirasi.status }}</td>
              </tr>
            </tbody>
          </table>
          <div
            class="flex justify-center p-5"
            v-if="aspirasis.links.length > 3"
          >
            <div class="join">
              <template v-for="(link, key) in aspirasis.links" :key="key">
                <Link
                  class="join-item btn btn-primary"
                  :class="{
                    'bg-white': link.active,
                    'btn-disabled': link.url === null,
                  }"
                  :href="link.url === null ? '/' : link.url"
                  v-html="link.label"
                />
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </LandingLayout>
</template>
