<template>
    <div class="space-y-6">
        <div class="mt-6 mb-9">
            <div class="bg-brand-gray-150 mx-3 sm:rounded-t-3xl flex justify-between items-center">
                <h2 class="text-lg text-brand-gray-300 uppercase font-bold px-4 py-4 tracking-widest">
                    {{ title }}
                </h2>

                <div v-if="buttonApproval" class="flex gap-2 px-5">
                    <button
                        @click="handleClickBulk('Reject')"
                        type="button"
                        class="inline-flex items-center px-3 py-2 text-xs bg-red-500 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-red transition ease-in-out duration-150"
                    >
                        Reject
                    </button>
                    <button
                        @click="handleClickBulk('Approve')"
                        type="button"
                        class="inline-flex items-center px-3 py-2 text-xs bg-green-500 border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green transition ease-in-out duration-150"
                    >
                        Approve
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="shadow-xl mx-auto overflow-hidden sm:rounded-3xl z-10 relative">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden border-b border-gray-200" :class="[maxHeight, overflowY]">
                                <table class="table-auto min-w-full divide-y divide-gray-40 bg-white">
                                    <thead :class="[`border-b-2 border-gray-300`, headerColor]">
                                        <tr :class="headerColor">
                                            <th v-if="headerCheckbox" :class="[positionHeader, headerColor]">
                                                <input type="checkbox" class="mx-3 my-auto" v-model="checkboxAll" @change="toggleSelectAll(reportData)" >
                                            </th>
                                            <th
                                                v-for="(header, index) in headers"
                                                :key="index"
                                                scope="col"
                                                class="py-5 text-left text-sm font-bold capitalize tracking-wider whitespace-nowrap"
                                                :class="[header == 'Action' ? 'text-center' + ` px-${px}` : `px-${px}`, textColor, positionHeader, headerColor]"
                                            >
                                                {{ header }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="rows.data.length" class="divide-y divide-gray-200">
                                        <slot></slot>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="100%" class="text-center text-sm py-4">No {{ units }} to display.</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <Pagination
                                    v-if="rows.meta"
                                    :title="units"
                                    :links="rows.meta.links"
                                    :per_page="rows.meta.per_page"
                                    :from="rows.meta.from"
                                    :to="rows.meta.to"
                                    :total="rows.meta.total"
                                    :prev_page_url="rows.links.prev"
                                    :next_page_url="rows.links.next"
                                    class="pb-5"
                                ></Pagination>
                                <Pagination
                                    v-else-if="rows.links"
                                    :title="units"
                                    :links="rows.links"
                                    :per_page="rows.per_page"
                                    :from="rows.from"
                                    :to="rows.to"
                                    :total="rows.total"
                                    :prev_page_url="rows.prev_page_url"
                                    :next_page_url="rows.next_page_url"
                                    class="pb-5"
                                ></Pagination>
                                <div v-else class="bg-white px-4 pt-3 pb-8 flex items-center justify-between border-t border-gray-200 sm:pt-6 sm:pb-9">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table end -->
            <div class="z-0 bg-brand-gray-150 -mt-2 mx-3 py-4 rounded-b-3xl"></div>
        </div>
    </div>
</template>

<script>
import Pagination from "@/Components/Pagination.vue";

export default {
    components: { Pagination },

    props: {
        rows: Object,
        title: {
            type: String,
            default: "Data Table"
        },
        units: {
            type: String,
            default: "results"
        },
        headers: {
            type: Array,
            default: () => []
        },
        px: {
            type: String,
            default: "4"
        },
        headerColor: {
            type: String,
            default: 'bg-white'
        },
        textColor: {
            type: String,
            default: 'text-black'
        },
        headerCheckbox:{
            type: null
        },
        reportData:{
            type: null
        },
        positionHeader:{
            type: null,
        },
        maxHeight:{
            type: null,
        },
        overflowY:{
            type: null,
        },
        buttonApproval:{
            type: null,
            default: false
        },
        onBulkSubmit: {
            type: null,
            default: false,
        }
    },
    data(){
        return {
            checkboxAll: false
        }
    },
    methods: {
        
    toggleSelectAll(data) {
            for (let i = 0; i < data.length; i++) {
                if (this.checkboxAll)
                {
                    data[i].checkbox = true;
                }else{
                    data[i].checkbox = false;
                }
            }
        },
        handleClickBulk(type) {
          this.onBulkSubmit(type, this.reportData);
        },
    },

    
};
</script>
