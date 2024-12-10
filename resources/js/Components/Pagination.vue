<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="pagination bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <!-- Mobile pagination -->
        <div class="flex-1 flex justify-between sm:hidden">
            <inertia-link
                v-if="prev_page_url !== null"
                :href="prev_page_url"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
            >
                Previous
            </inertia-link>
            <div class="relative inline-flex items-center px-4 py-2">
                <p class="text-sm text-brand-gray-200">
                    Showing
                    <span class="font-bold">{{ per_page > total ? total : per_page }}</span>
                    out of
                    <span class="font-bold">{{ total }}</span>
                    {{ title }}
                </p>
            </div>
            <inertia-link
                v-if="next_page_url !== null"
                :href="next_page_url"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
            >
                Next
            </inertia-link>
        </div>

        <!-- Web pagination -->
        <div class="hidden sm:block sm:w-full">
            <div class="mb-3">
                <p class="text-sm text-brand-gray-200">
                    Showing
                    <span class="font-bold">{{ per_page > total ? total : shown }}</span>
                    out of
                    <span class="font-bold">{{ total }}</span>
                    {{ title }}
                </p>
            </div>
            <nav class="flex items-center justify-center gap-5" aria-label="Pagination">
                <inertia-link
                    as="button"
                    :href="prev_page_url ? prev_page_url : '#'"
                    :disabled="!prev_page_url"
                    class="px-6 py-2 bg-brand-gray-400 text-white flex items-center justify-center rounded-md focus:outline-none"
                    :class="!prev_page_url ? 'opacity-25 cursor-not-allowed' : 'hover:bg-gray-600'"
                >
                    <span class="sr-only">Previous</span>
                    <!-- Heroicon name: solid/chevron-left -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </inertia-link>

                <div v-for="(link, index) in links" :key="index">
                    <inertia-link
                        v-if="index != 0 && index != links.length - 1"
                        :href="link.url ? link.url : '#'"
                        class="text-lg hover:text-gray-600 focus:outline-none "
                        :class="link.active ? 'font-bold text-black' : 'font-semibold text-brand-gray-200'"
                    >
                        {{ link.label }}
                    </inertia-link>
                </div>

                <inertia-link
                    as="button"
                    :href="next_page_url ? next_page_url : '#'"
                    :disabled="!next_page_url"
                    class="px-6 py-2 bg-brand-gray-400 text-white flex items-center justify-center rounded-md focus:outline-none"
                    :class="!next_page_url ? 'opacity-25 cursor-not-allowed' : 'hover:bg-gray-600'"
                >
                    <span class="sr-only">Next</span>
                    <!-- Heroicon name: solid/chevron-right -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </inertia-link>
            </nav>
        </div>
    </div>
</template>

<script setup>
// Importing computed from Vue
import { computed } from 'vue';

const props = defineProps({
    title: {
        type: String,
        default: "results"
    },
    links: Array,
    per_page: Number,
    from: Number,
    to: Number,
    total: Number,
    prev_page_url: {
        type: String,
        default: "#"
    },
    next_page_url: {
        type: String,
        default: "#"
    }
});

const shown = computed(() => {
    return props.to - props.from + 1;
});
</script>
