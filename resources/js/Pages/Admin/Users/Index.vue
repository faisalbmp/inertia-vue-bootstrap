<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="px-6">
            <DataTable title="User Account List" units="accounts" :rows="users" :headers="tableHeaders" px="6">
                <template v-for="(user, index) in users.data" :key="index">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 font-semibold">{{ user.name }}</div>
                            <div class="text-sm text-gray-500">{{ user.email }}</div>
                            <div class="flex space-x-2">
                                <BadgesStatus class="cursor-pointer pt-1" :status="user.active ? 'Active' : 'Inactive'"></BadgesStatus>
                                <BadgesStatus class="cursor-pointer" :status="user.first_time_login ? 'Already Login' : 'Not Login Yet'"></BadgesStatus>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="text-sm text-gray-500 font-semibold">{{ user.role_display_name }} 
                                <span v-if="user.online_leads"> - Online Leads</span> 
                                <span v-if="user.dedicated_ev"> - EV Dedicated</span>
                            </div>
                            <div v-if="user.job_title" class="text-sm text-gray-500">
                                Title: {{ user.job_title }}
                            </div>
                            <div v-if="user.role === 'group-dealer'" class="text-sm text-gray-500">
                                {{ user.group_dealer ? user.group_dealer.name : "" }}
                            </div>
                            <div v-if="user.role === 'salesman' || user.role === 'sales-counter' || user.role === 'supervisor'  || user.role === 'sales-manager'" class="text-sm text-gray-500">
                                Superior: {{ user.supervisor ? '[' + user.supervisor.roles[0].display_name + '] ' + user.supervisor.name : "-" }}
                            </div>
                            <div v-for="(dealer, index) in user.dealers" :key="index" class="text-sm text-gray-500">{{ dealer }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <ul class="list-disc ml-3">
                                <li v-for="(permission, index) in user.role_permissions" :key="index" class="whitespace-normal">
                                    {{ permission }}
                                </li>
                            </ul>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <ul class="list-disc ml-3">
                                <li v-for="(permission, index) in user.user_permissions" :key="index" class="whitespace-normal">
                                    {{ permission }}
                                </li>
                            </ul>
                        </td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </AppLayout>
</template>

<script setup>
import DataTable from "@/Components/Table/DataTable.vue";
import AppLayout from '@/Layouts/AppLayout.vue';
// import BadgesStatus from "@/Components/Badges/BadgesStatus.vue";

// Define props directly
defineProps({
    users: Array
});

// Register components directly
const components = {
    DataTable,
    // BadgesStatus
};
</script>

<style scoped>
</style>
