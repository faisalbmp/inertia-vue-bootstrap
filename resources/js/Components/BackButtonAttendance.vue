<template>
  <button @click="historyBack" class="px-5 py-3 border-r border-gray-200 text-gray-500 focus:outline-none">
      <span class="sr-only">Back</span>
      <!-- Heroicon name: outline/menu-alt-2 -->
      <div class="opacity-60">
        <LeftArrow size="20" />
      </div>
  </button>
</template>

<script>
import LeftArrow from "@/Components/Icons/LeftArrow.vue"

export default {
  name: 'BackButton',
  components: {
    LeftArrow
  },
  methods: {
    historyBack() {
      window.location.href = '/app/spv/attendance/'
    }
  }
}
</script>