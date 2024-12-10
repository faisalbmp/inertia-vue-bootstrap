<template>
    <div class="h-screen flex overflow-hidden">
        <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
        <transition :duration="300">
            <div v-show="showingNavigationSidebar" class="md:hidden">
                <div class="fixed inset-0 flex z-40">
                    <transition
                        enter-active-class="transition-opacity ease-linear duration-300"
                        enter-from-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="transition-opacity ease-linear duration-300"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <div @click="showingNavigationSidebar = !showingNavigationSidebar" v-show="showingNavigationSidebar" class="fixed inset-0" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                        </div>
                    </transition>
                    <transition
                        enter-active-class="transition ease-in-out duration-300 transform"
                        enter-from-class="-translate-x-full"
                        enter-to-class="translate-x-0"
                        leave-active-class="transition ease-in-out duration-300 transform"
                        leave-from-class="translate-x-0"
                        leave-to-class="-translate-x-full"
                    >
                        <!--<div>-->
                        <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">
                            <div class="absolute top-0 left-0 -mr-12 pt-2">
                                <button @click="showingNavigationSidebar = !showingNavigationSidebar" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                                    <span class="sr-only">Close sidebar</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                        <path d="M35.58 973.7a1.292 1.292 0 0 0-1.826 0l-5.3 5.3-5.3-5.3a1.291 1.291 0 0 0-1.826 1.826l5.3 5.3-5.3 5.3a1.291 1.291 0 0 0 1.826 1.826l5.3-5.3 5.3 5.3a1.291 1.291 0 0 0 1.826-1.826l-5.3-5.3 5.3-5.3a1.292 1.292 0 0 0 0-1.826z" transform="rotate(180 17.979 494.16)"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex-shrink-0 flex items-center p-4 mt-10 mx-8">
                                <a :href="route('dashboard')" style="display: contents">
                                    <img class="w-1/3" src="/images/logo-brand.png" width="40" alt="Xylo">
                                </a>
                            </div>

                            <div v-if="$page.props.auth.user" class="mt-5 flex-1 h-0 overflow-y-auto">
                                <nav class="px-0 space-y-1">
                                    <!-- <AppMenu /> -->
                                </nav>
                            </div>
                        </div>
                        <!-- <div class="flex-shrink-0 w-14" aria-hidden="true">
                            Dummy element to force sidebar to shrink to fit close icon
                        </div> -->
                    </transition>
                </div>
            </div>
        </transition>

        <!-- Static sidebar for desktop -->
        <div v-show="!showingNavigationSidebar && !hideNavbar" class="hidden md:flex md:flex-shrink-0 w-58 z-20 shadow-2xl">
            <div class="flex flex-col">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex flex-col h-0 flex-1 bg-white">
                    <!-- Logo -->
                    <div class="flex items-center flex-shrink-0 p-6">
                        <a :href="route('dashboard')" style="display: contents">
                            <img class="py-2 w-36 mx-auto" src="/images/logo-brand.png" alt="Wuling">
                        </a>
                    </div>

                    <div class="flex-1 flex flex-col overflow-y-auto">
                        <!-- User Info -->
                        <div v-if="$page.props.auth.user" class="px-5">
                            <label class="block text-sm font-semibold">{{ $page.props.auth.user.name }}</label>
                            <!-- <label class="text-xs">{{ $page.props.auth.user.roles.map(role => role.name).join(', ') }}</label> -->
                        </div>

                        <!-- Main Menu-->
                        <nav v-if="$page.props.auth.user" class="flex-1 px-2 py-4 space-y-1">
                            <!-- <WebMenu @isRedirect="isRedirect"/> -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <!-- Top Bar -->
            <div v-if="hideNavbar" class="relative z-10 flex-shrink-0 flex h-16 bg-brand-gray-100 items-center justify-between" :class="[background ? background : '']"></div>
            <div v-if="!hideNavbar" class="relative z-10 flex-shrink-0 flex h-16 bg-brand-gray-100 items-center justify-between" :class="[background ? background : '']">
                    <button v-if="!hideMenu" @click="showingNavigationSidebar = !showingNavigationSidebar" class="px-5 py-3 border-r border-gray-200 text-gray-500 focus:outline-none">
                        <span class="sr-only">Open sidebar</span>
                        <!-- Heroicon name: outline/menu-alt-2 -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>
                    <BackButtonAttendance v-else-if="showBackAttendance" />
                    <BackButton :to="backButtonRoute" :pages="currentPages" v-else />

                    <div class="mx-auto text-black capitalize">
                        <slot name="pagetitle"></slot>
                    </div>

                    <div v-if="$page.props.auth" class="px-4 flex justify-end">
                        <div class="flex items-center space-x-5">
                           <!--  <inertia-link @click="isRedirect" :href="route('notifications.index')" class="bg-transparent p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none">
                                <span class="inline-block relative mt-2">
                                    <span class="sr-only">View notifications</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                    </svg>
                                    <span v-if="$page.props.hasNewNotifications" class="absolute top-0 right-0 block h-2 w-2 transform -translate-y-1/2 translate-x-1/2 rounded-full ring-2 ring-white bg-red-400"></span>
                                </span>
                            </inertia-link> -->
                            <form @submit.prevent="logout" class="hidden md:block">
                                <button class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none" type="submit">
                                    <span class="sr-only">Logout</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
            </div>

            <!-- Page Content -->
            <main id="mainapp" class="flex-1 relative overflow-y-auto focus:outline-none bg-brand-gray-100" tabindex="0">
                <div class="sm:pt-6 md:pt-6">
                    <!-- Page Heading -->
                    <header class="hidden sm:block max-w-7xl mx-auto px-4 sm:px-6 md:px-8" v-if="$slots.header">
                        <page-heading>
                            <template #header-title>
                                <slot name="header"></slot>
                            </template>

                            <template #header-action>
                                <slot name="action"></slot>
                            </template>
                        </page-heading>
                    </header>

                    <div class="max-w-7xl mx-auto sm:px-6 md:px-8">
                        <!-- Page Content -->
                        <main>
                            <flash-message class="hidden"></flash-message>
                            <pop-up-dialog-status></pop-up-dialog-status>

                            <slot></slot>
                        </main>
                    </div>

                    <footer class="bg-brand-gray-150 h-12 mt-14 px-8 py-2 border-t border-gray-400">
                        <label class="text-brand-gray-200 text-sm">Copyright © 2021 Wuling Indonesia</label>
                    </footer>
                </div>
            </main>
        </div>
    </div>

</template>


<script setup>
// import FlashMessage from "@/Components/FlashMessage.vue";
import NavLink from "@/Components/NavLink.vue";
import Button from "@/Components/PrimaryButton.vue";
import PageHeading from "@/Components/PageHeading.vue"
import WebMenu from "@/Components/WebMenu.vue"
// import AppMenu from "@/Components/AppMenu.vue"
// import PopUpDialogStatus from "@/Components/PopUpDialogStatus.vue";
import BackButton from '@/Components/BackButton.vue'
import BackButtonAttendance from '@/Components/BackButtonAttendance.vue'
import {ref,computed} from 'vue'
import { usePage } from '@inertiajs/vue3';
const page = usePage();

console.log('hei',page.props);
const user = computed(() => page.props.auth.user);

// Define props directly
const props = defineProps({
    background: {
        type: String,
        default: 'bg-brand-gray-100'
    },
    hideMenu: {
        type: Boolean,
        default: false
    },
    showBackAttendance: {
        type: Boolean,
        default: false
    },
    backButtonRoute: {
        type: String,
        default: ''
    },
    currentPages: {
        type: String,
        default: ''
    },
    hideNavbar: {
        type: Boolean,
        default: false
    }
});

// Define components directly
const components = {
    // PopUpDialogStatus,
    Button,
    NavLink,
    // FlashMessage,
    PageHeading,
    // WebMenu,
    // AppMenu,
    BackButton,
    BackButtonAttendance
};

/* const $page.props.auth = computed(() => {
    return $page.props.$page.props.auth;
}); */

const showingNavigationDropdown = ref(false);
const showingNavigationSidebar = ref(false);

function switchToTeam(team) {
    $inertia.put(route('current-team.update'), {
        'team_id': team.id
    }, {
        preserveState: false
    });
}

async function logout() {
    emit('userLogout');
    await axios.post(route('custom.logout')).then(function (res) {
        return window.location.href = '/login';
    });
}

function isRedirect() {
    emit('isRedirect');
}
</script>


<style lang="css">
    #mainapp {
        min-height: 100vh;
    }

    #mainapp > div {
        min-height: 100vh!important;
    }
</style>
