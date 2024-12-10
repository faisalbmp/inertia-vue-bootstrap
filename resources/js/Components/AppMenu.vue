<template>
    <div class="flex flex-col justify-between">
        <!-- Mobile -->
        <div class="block md:hidden">
            <div v-if="userapp.salesman.includes(user.role.name)" class="h-auto text-brand-gray-200">
                <nav>
                    <ul>
                        <li v-for="(menu, i) in salesman_menu" :key="`menu-${i}`">
                            <xylo-nav-link
                                v-if="menu.canAccess"
                                :href="menu.slug !== '' ? route(menu.slug) : '#'"
                                class="text-lg sm:text-sm flex items-center px-8 md:px-0"
                                :active="menu.slug !== '' ? route().current(menu.slug) : false"
                            >
                                <div class="mr-3 w-8 h-8 flex items-center justify-center text-center">
                                    <img :src="`/images/${menu.icon}`" class="mx-auto inline-block" alt="" />
                                </div>

                                <span class="text-md sm:text-md">{{ menu.title }}</span>
                            </xylo-nav-link>
                        </li>
                    </ul>
                </nav>
            </div>

            <div v-else-if="userapp.supervisor.includes(user.role.name)" class="h-auto text-brand-gray-200">
                <nav>
                    <ul>
                        <li v-for="(menu, i) in supervisor_menu" :key="`menu-${i}`">
                            <xylo-nav-link
                                v-if="menu.canAccess"
                                :href="menu.title !== 'Incoming Leads' ? route(menu.slug) : route(menu.slug)"
                                class="text-lg sm:text-sm flex items-center px-8 md:px-0"
                                :active="menu.slug !== '' ? route().current(menu.slug) : false"
                            >
                                <div class="mr-3 w-8 h-8 flex items-center justify-center text-center">
                                    <img :src="`/images/${menu.icon}`" class="mx-auto inline-block" alt="" />
                                </div>
                                <span class="text-md sm:text-md">{{ menu.title }}</span>
                                <span>{{ menu.active }}</span>
                            </xylo-nav-link>
                        </li>
                    </ul>
                </nav>
            </div>

            <div v-else-if="userapp.admin_eo.includes(user.role.name)" class="h-auto text-brand-gray-200">
                <nav>
                    <ul>
                        <li v-for="(menu, i) in admin_eo_menu" :key="`menu-${i}`">
                            <xylo-nav-link
                                v-if="menu.canAccess"
                                :href="menu.title !== 'Incoming Prospects' ? route(menu.slug) : route(menu.slug)"
                                class="text-lg sm:text-sm flex items-center px-8 md:px-0"
                                :active="menu.slug !== '' ? route().current(menu.slug) : false"
                            >
                                <div class="mr-3 w-8 h-8 flex items-center justify-center text-center">
                                    <img :src="`/images/${menu.icon}`" class="mx-auto inline-block" alt="" />
                                </div>
                                <span class="text-md sm:text-md">{{ menu.title }}</span>
                                <span>{{ menu.active }}</span>
                            </xylo-nav-link>
                        </li>
                    </ul>
                </nav>
            </div>

            <div v-else-if="userapp.service_advisor.includes(user.role.name)" class="h-auto text-brand-gray-200">
                <nav>
                    <ul>
                        <li v-for="(menu, i) in service_advisor_menu" :key="`menu-${i}`">
                            <div v-if="menu.canAccess">
                                <div v-if="menu.isDropdown === true">
                                    <xylo-nav-link as="dropdown" class="text-md sm:text-sm" @dropdown="dropdown(menu.menudropdown)">
                                        <div class="flex items-center px-8 md:px-0 gap-x-2">
                                            <div class="flex">
                                                <div class="mr-3 w-8 h-8 flex items-center justify-center text-center">
                                                    <img v-if="!openMenu(menu.menudropdown)" :src="`/images/${menu.icon}`"
                                                        alt="" class="mx-auto inline-block w-4"/>
                                                    <img v-if="openMenu(menu.menudropdown)" :src="`/images/${menu.icon_fill}`"
                                                        alt="" class="mx-auto inline-block w-4"/>
                                                </div>
                                                <span v-if="!openMenu(menu.menudropdown)"
                                                    class="text-md sm:text-md my-auto">{{ menu.title }}</span>
                                                <span v-if="openMenu(menu.menudropdown)"
                                                    class="text-md sm:text-md my-auto font-bold text-black">
                                                    {{ menu.title }}
                                                </span>
                                            </div>
                                            <!-- Fontawesome name: chevron-up -->
                                            <svg
                                                v-if="openMenu(menu.menudropdown)"
                                                aria-hidden="true"
                                                class="svg-inline--fa fa-chevron-up fa-w-14 h-2.5 w-3 cursor-pointer"
                                                data-icon="chevron-up"
                                                data-prefix="fas"
                                                focusable="false"
                                                role="img"
                                                viewBox="0 0 448 512"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M240.971 130.524l194.343 194.343c9.373 9.373 9.373 24.569 0 33.941l-22.667 22.667c-9.357 9.357-24.522 9.375-33.901.04L224 227.495 69.255 381.516c-9.379 9.335-24.544 9.317-33.901-.04l-22.667-22.667c-9.373-9.373-9.373-24.569 0-33.941L207.03 130.525c9.372-9.373 24.568-9.373 33.941-.001z"
                                                    fill="currentColor"
                                                ></path>
                                            </svg>
                                            <!-- Fontawesome name: chevron-down -->
                                            <svg
                                                v-if="!openMenu(menu.menudropdown)"
                                                aria-hidden="true"
                                                class="svg-inline--fa fa-chevron-down fa-w-14 h-2.5 w-3 cursor-pointer"
                                                data-icon="chevron-down"
                                                data-prefix="fas"
                                                focusable="false"
                                                role="img"
                                                viewBox="0 0 448 512"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"
                                                    fill="currentColor"
                                                ></path>
                                            </svg>
                                        </div>
                                    </xylo-nav-link>
                                    <div
                                        v-if="openMenu(menu.menudropdown)"
                                        class="[showDropdown ? transition ease-out duration-100 transform opacity-100 scale-100 : transition ease-in duration-75 transform opacity-0 scale-95]"
                                    >
                                        <div v-for="(main, i) in menu.listDropdown" :key="`main-${i}`">
                                            <div v-if="main.canAccess">
                                                <xylo-nav-link
                                                    :href="main.slug !== '' ? route(main.slug) : '#'"
                                                    class="text-lg sm:text-sm"
                                                    :active="main.slug !== '' ? route().current(main.slug) : false"
                                                >
                                                    <div
                                                        class="ml-12 w-8 h-6 flex items-center justify-center text-center"></div>
                                                    <span class="text-sm sm:text-sm my-auto">{{ main.title }}</span>
                                                </xylo-nav-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <xylo-nav-link
                                        :href="menu.slug !== '' ? route(menu.slug) : '#'"
                                        class="text-lg sm:text-sm flex items-center px-8 md:px-0"
                                        :active="menu.slug !== '' ? route().current(menu.slug) : false"
                                    >
                                        <div class="mr-3 w-8 h-8 flex items-center justify-center text-center">
                                            <img :src="`/images/${menu.icon}`" class="mx-auto inline-block" alt="" />
                                        </div>
                                        <span class="text-md sm:text-md">{{ menu.title }}</span>
                                    </xylo-nav-link>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>

            <div v-else class="h-auto text-brand-gray-200">
                <nav>
                    <ul>
                        <li v-for="(menu, i) in default_menu" :key="`menu-${i}`">
                            <xylo-nav-link
                                v-if="menu.canAccess"
                                :href="route(menu.slug)"
                                class="text-lg sm:text-sm flex items-center px-8 md:px-0"
                                :active="menu.slug !== '' ? route().current(menu.slug) : false"
                            >
                                <div class="mr-3 w-8 h-8 flex items-center justify-center text-center">
                                    <img :src="`/images/${menu.icon}`" class="mx-auto inline-block" alt="" />
                                </div>
                                <span class="text-md sm:text-md">{{ menu.title }}</span>
                                <span>{{ menu.active }}</span>
                            </xylo-nav-link>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="mt-10">
                <div class="text-lg sm:text-sm flex items-center px-10 md:px-0 cursor-pointer" @click="logout">
                    <div class="mr-3 w-8 h-8 flex items-center justify-center text-center">
                        <img src="/images/logout.svg" class="mx-auto inline-block" alt="" />
                    </div>

                    <span class="text-sm sm:text-sm">Logout</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import XyloNavLink from "@/Components/NavLink.vue";

import {ref,computed} from 'vue'
import { usePage } from '@inertiajs/vue3';
const page = usePage();
const user = computed(() => page.props.auth.user);
export default {
    props: {
        features: {
            type: Object,
            default: function () {
                return this.page.props.features;
            }
        }
    },
    data() {
        return {
            salesman_menu: [
                {
                    title: "Home",
                    icon: "home_icon.svg",
                    slug: "dashboard",
                    canAccess : true,
                },
                {
                    title: "Attendance",
                    icon: "absensi_icon.svg",
                    slug: "attendance.index",
                    canAccess : true,
                },
                {
                    title: "Input New Leads",
                    icon: "input_icon.svg",
                    slug: "prospects.create",
                    canAccess : true,
                },
                {
                    title: "Leads Data",
                    icon: "prospect_data.svg",
                    slug: "followups.index",
                    canAccess : true,
                },
                {
                    title: "SPK & Target",
                    icon: "target_icon.svg",
                    slug: "spk",
                    canAccess : true,
                },
                {
                    title: "DO",
                    icon: "do.svg",
                    slug: "do",
                    canAccess : true,
                },
                {
                    title: "Schedule",
                    icon: "schedule_icon.svg",
                    slug: "schedules.index",
                    canAccess : true,
                },
                {
                    title: "QR Code Scanner",
                    icon: "qr_scanner.svg",
                    slug: "scanner",
                    canAccess : true,
                },
                {
                    title: "Rewards",
                    icon: "rewards_icon.svg",
                    slug: "rewards",
                    canAccess: this.page.props.permissions.ApplicationRewards,
                },
                {
                    title: "Promotion Tools",
                    icon: "promo_icon.svg",
                    slug: "promotion.tools",
                    canAccess : true,
                }
                // {
                //     title: 'Help',
                //     icon: 'help_icon.svg',
                //     slug: ''
                // },
                // {
                //     title: 'Languages',
                //     icon: 'language_icon.svg',
                //     slug: ''
                // },
            ],

            supervisor_menu: [
                {
                    title: "Home",
                    icon: "home_icon.svg",
                    slug: "dashboard",
                    canAccess : true,
                },
                {
                    title: "Attendance",
                    icon: "absensi_icon.svg",
                    slug: "spv.attendance.index",
                    canAccess : true,
                },
                // {
                //     title: "Incoming Prospects",
                //     icon: "ktp.svg",
                //     slug: "spv.incoming.prospects",
                //     canAccess : true,
                // },
                /*{
                    title: "Skip Requests",
                    icon: "skipQR.svg",
                    slug: "spv.skip.request"
                },*/
                {
                    title: "Leads Data",
                    icon: "prospect_data.svg",
                    slug: "spv.followup",
                    canAccess : true,
                },
                {
                    title: "Sales Performance",
                    icon: "salesperformance.svg",
                    slug: "spv.sales-performance",
                    canAccess : true,
                },
                {
                    title: "SPK & Target",
                    icon: "target_icon.svg",
                    slug: "spv.spk",
                    canAccess : true,
                },
                {
                    title: "DO Data",
                    icon: "do.svg",
                    slug: "spv.do",
                    canAccess : true,
                },
                {
                    title: "My Sales People",
                    icon: "sales_people.svg",
                    slug: "spv.sales.people",
                    canAccess : true,
                },
                {
                    title: "Promotion Tools",
                    icon: "promo_icon.svg",
                    slug: "promotion.tools",
                    canAccess : true,
                }
            ],

            default_menu: [
                {
                    title: "Home",
                    icon: "home_icon.svg",
                    slug: "dashboard",
                    canAccess : true,
                },
            ],

            admin_eo_menu: [
                {
                    title: "Home",
                    icon: "home_icon.svg",
                    slug: "dashboard",
                    canAccess : true,
                },
                {
                    title: "Test Drive National event",
                    icon: "target_icon.svg",
                    slug: "app.national-event.test-drive.list",
                    canAccess: this.features.national_event && (this.page.props.permissions.AccessNationalEvent ||this.page.props.auth.user.role.name == "admin-eo-test-drive-luar" ||this.page.props.auth.user.role.name == "admin-eo-test-drive-dalam" )
                },
            ],

            service_advisor_menu: [
            {
                    title: "Home",
                    icon: "home_icon.svg",
                    slug: "dashboard",
                    canAccess : true,
                },
                {
                    title: "Input New Leads",
                    icon: "input_icon.svg",
                    slug: "prospects.create",
                    canAccess : true,
                },
                {
                    title: "Leads Data",
                    icon: "prospect_data.svg",
                    slug: "followups.index",
                    canAccess : true,
                },
                {
                    title: "Schedule",
                    icon: "schedule_icon.svg",
                    slug: "schedules.index",
                    canAccess : true,
                },
                {
                    title: "QR Code Scanner",
                    icon: "qr_scanner.svg",
                    slug: "scanner",
                    canAccess : true,
                },
                {
                    title: "Promotion Tools",
                    icon: "promo_icon.svg",
                    slug: "promotion.tools",
                    canAccess : true,
                },
            ]
        };
    },
    components: {
        XyloNavLink
    },
    computed: {
        role() {
            return this.page.props.roles;
        },

        permission() {
            return this.page.props.permissions;
        },

        userapp() {
            return this.page.props.usergroup.apps;
        },

        user() {
            return this.page.props.auth.user;
        },
    },
    methods: {
        // logout() {
        //     this.$inertia.post(route("custom.logout"));
        // }
        async logout() {
            await axios.post(route('custom.logout')).then(function (res){
               return window.location.href = '/login'
            });
            // this.$inertia.post(route('custom.logout'));
        }
    }
};
</script>

<style>
::-webkit-scrollbar {
    width: 3px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #888;
}
</style>
