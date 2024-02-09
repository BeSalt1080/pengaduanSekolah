<script setup>
import { Link } from "@inertiajs/vue3";
import { onMounted, onUnmounted, ref } from "vue";

var lastScrollY = 0;
const scrolledUp = ref(false);
const scrollHandler = () => {
  if (window.scrollY == 0) {
    scrolledUp.value = false;
    return;
  }
  if (lastScrollY > window.scrollY) scrolledUp.value = true;
  else scrolledUp.value = false;
  lastScrollY = window.scrollY;
};

onMounted(() => {
  window.addEventListener("scroll", scrollHandler);
});
onUnmounted(() => {
  window.removeEventListener("scroll", scrollHandler);
});
</script>
<template class="bg-base-100">
  <div
    class="navbar bg-base-100 shadow-md ease-in-out"
    :class="{ 'sticky top-0 z-10': scrolledUp }"
  >
    <div class="flex-1">
      <a class="btn btn-ghost text-xl">Pengaduan Sekolah</a>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal px-1">
        <form :action="route('search')" method="get" v-if="!route().current('search')">
          <input
            name="q"
            type="search"
            placeholder="Cari Pengaduan…"
            autocomplete="off"
            spellcheck="false"
            class="input input-bordered w-full h-9"
          />
          <button></button>
        </form>
        <li><Link :href="route('welcome')+'#profile'">Profile</Link></li>
        <li><Link :href="route('login')">Admin</Link></li>
      </ul>
    </div>
  </div>
  <slot />
  <footer class="footer footer-center p-4 bg-base-300 text-base-content">
    <aside>
      <p>Copyright © 2024 - All right reserved by Shinichi Wijaya</p>
    </aside>
  </footer>
</template>
