<template>
    <div class="flex flex-col justify-between">
        <!-- Desktop -->
        <div class="h-96 text-brand-gray-200 hidden md:block">
            <div v-for="(menu, i) in desktop_menu" :key="`menu-${i}`">
                <div v-if="menu.canAccess">
                    <div v-if="menu.isDropdown === true">
                        <xylo-nav-link as="dropdown" class="text-xl sm:text-sm" @dropdown="dropdown(menu.menudropdown)">
                            <div class="flex w-full items-center justify-between">
                                <div class="flex">
                                    <div class="mr-2 w-8 h-8 flex items-center justify-center text-center">
                                        <img v-if="!openMenu(menu.menudropdown)" :src="`/images/${menu.icon}`"
                                             alt="" class="mx-auto inline-block w-4"/>
                                        <img v-if="openMenu(menu.menudropdown)" :src="`/images/${menu.icon_fill}`"
                                             alt="" class="mx-auto inline-block w-4"/>
                                    </div>
                                    <span v-if="!openMenu(menu.menudropdown)"
                                          class="text-xl sm:text-sm my-auto">{{ menu.title }}</span>
                                    <span v-if="openMenu(menu.menudropdown)"
                                          class="text-xl sm:text-sm my-auto font-bold text-black">{{
                                            menu.title
                                        }}</span>
                                </div>
                                <!-- Fontawesome name: chevron-up -->
                                <svg
                                    v-if="openMenu(menu.menudropdown)"
                                    aria-hidden="true"
                                    class="svg-inline--fa fa-chevron-up fa-w-14 h-3 w-3 cursor-pointer"
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
                                    class="svg-inline--fa fa-chevron-down fa-w-14 h-3 w-3 cursor-pointer"
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
                                    <div v-if="main.isDropdown === true">
                                        <xylo-nav-link as="dropdown" class="text-xl sm:text-sm"
                                                       @dropdown="dropdown(main.dropdownsub)">
                                            <div class="flex w-full items-center justify-between">
                                                <div class="flex">
                                                    <div
                                                        class="ml-4 w-8 h-8 flex items-center justify-center text-center"></div>
                                                    <span v-if="!openMenu(main.dropdownsub)"
                                                          class="text-xs sm:text-sm my-auto">{{ main.title }}</span>
                                                    <span v-if="openMenu(main.dropdownsub)"
                                                          class="text-xl sm:text-sm my-auto font-bold text-black">{{
                                                            main.title
                                                        }}</span>
                                                </div>
                                                <!-- Fontawesome name: chevron-up -->
                                                <svg
                                                    v-if="openMenu(main.dropdownsub)"
                                                    aria-hidden="true"
                                                    class="svg-inline--fa fa-chevron-up fa-w-14 h-3 w-3 cursor-pointer"
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
                                                    v-if="!openMenu(main.dropdownsub)"
                                                    aria-hidden="true"
                                                    class="svg-inline--fa fa-chevron-down fa-w-14 h-3 w-3 cursor-pointer"
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
                                            v-if="openMenu(main.dropdownsub)"
                                            class="[showDropdown ? transition ease-out duration-100 transform opacity-100 scale-100 : transition ease-in duration-75 transform opacity-0 scale-95]"
                                        >
                                            <div v-for="(submain, i) in main.listDropdown" :key="`submain-${i}`">
                                                <div
                                                    v-if="(submain.isDropdown === true && submain.dropdownsub !== 'group-sales') || (submain.isDropdown === true && submain.dropdownsub === 'group-sales' && !roles.hasRoleSuperadmin)">
                                                    <xylo-nav-link as="dropdown"
                                                                   class="text-xl sm:text-sm"
                                                                   @dropdown="dropdown(submain.dropdownsub)">
                                                        <div class="flex w-full items-center justify-between">
                                                            <div class="flex">
                                                                <!-- <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10 h-3 w-3 ml-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg> -->
                                                                <span v-if="!openMenu(submain.dropdownsub)"
                                                                      class="text-xl sm:text-sm my-auto ml-16">{{
                                                                        submain.title
                                                                    }}</span>
                                                                <span v-if="openMenu(submain.dropdownsub)"
                                                                      class="text-xl sm:text-sm my-auto ml-16 font-bold text-black">
                                                                    {{ submain.title }}
                                                                </span>
                                                            </div>
                                                            <!-- Fontawesome name: chevron-up -->
                                                            <svg
                                                                v-if="openMenu(submain.dropdownsub)"
                                                                aria-hidden="true"
                                                                class="svg-inline--fa fa-chevron-up fa-w-14 h-3 w-3 cursor-pointer"
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
                                                                v-if="!openMenu(submain.dropdownsub)"
                                                                aria-hidden="true"
                                                                class="svg-inline--fa fa-chevron-down fa-w-14 h-3 w-3 cursor-pointer"
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
                                                        v-if="openMenu(submain.dropdownsub)"
                                                        class="[showDropdown ? transition ease-out duration-100 transform opacity-100 scale-100 : transition ease-in duration-75 transform opacity-0 scale-95]"
                                                    >
                                                        <div v-for="(subsubmain, i) in submain.listDropdown"
                                                             :key="`subsubmain-${i}`">
                                                            <xylo-nav-link
                                                                :active="subsubmain.slug !== '' ? subsubmain.param !== '' ? getActiveRoute(subsubmain.slug, subsubmain.param) : route().current(subsubmain.slug) : false"
                                                                :href="subsubmain.slug !== '' ? subsubmain.param !== '' ? route(subsubmain.slug, { group : subsubmain.param } ) : route(subsubmain.slug) : '#'"
                                                                class="text-xl sm:text-sm"
                                                            >
                                                                <div @click="isClicked" class="flex w-full items-center">
                                                                    <span class="text-xl sm:text-sm my-auto ml-20">{{
                                                                            subsubmain.title
                                                                        }}</span>
                                                                </div>
                                                            </xylo-nav-link>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-else>
                                                    <xylo-nav-link
                                                        v-if="submain.canAccess == undefined || submain.canAccess"
                                                        :active="submain.slug !== '' ? route().current(submain.slug) : false"
                                                        :href="submain.slug !== '' ? route(submain.slug) : '#'"
                                                        class="text-xl sm:text-sm"
                                                    >
                                                        <div @click="isClicked" class="flex w-full items-center">
                                                            <!-- Fontawesome name: chevron-right -->
                                                            <!-- <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10 h-3 w-3 ml-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg> -->
                                                            <span class="text-xl sm:text-sm my-auto ml-16">{{
                                                                    submain.title
                                                                }}</span>
                                                        </div>
                                                    </xylo-nav-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <xylo-nav-link
                                            v-if="main.param"
                                            :active="main.slug !== '' ? route().current(main.slug) : false"
                                            :href="main.slug !== '' ? route(main.slug, main.param) : '#'"
                                            class="text-xl sm:text-sm"
                                        >
                                            <div @click="isClicked" class="w-full flex">
                                                <div
                                                    class="ml-4 w-8 h-8 flex items-center justify-center text-center"></div>
                                                <span class="text-xs sm:text-sm my-auto">{{ main.title }}</span>
                                            </div>
                                        </xylo-nav-link>
                                        <xylo-nav-link
                                            v-if="!main.param"
                                            @click="isClicked"
                                            :active="main.slug !== '' ? route().current(main.slug) : false"
                                            :href="main.slug !== '' ? route(main.slug) : '#'"
                                            class="text-xl sm:text-sm"
                                        >
                                            <div @click="isClicked" class="w-full flex">
                                                <div
                                                    class="ml-4 w-8 h-8 flex items-center justify-center text-center"></div>
                                                <span class="text-xs sm:text-sm my-auto">{{ main.title }}</span>
                                            </div>
                                        </xylo-nav-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <xylo-nav-link
                            v-if="roles.hasRoleSuperadmin"
                            :active="menu.slug !== '' ? route().current(menu.slug) : false"
                            :href="menu.slug !== '' ? route(menu.slug) : '#'"
                            class="text-xl sm:text-sm"
                        >
                            <div @click="isClicked" class="w-full flex">
                                <div class="mr-3 w-8 h-8 flex items-center justify-center text-center">
                                    <img v-if="route().current(menu.slug)" :src="`/images/${menu.icon_fill}`"
                                         alt="" class="mx-auto inline-block w-5 h-5"/>
                                    <img v-else :src="`/images/${menu.icon}`" alt="" class="mx-auto inline-block w-5 h-5"/>
                                </div>
                                <span class="text-xl sm:text-sm my-auto">{{ menu.title }}</span>
                            </div>
                        </xylo-nav-link>
                    </div>
                </div>
            </div>
            <xylo-nav-link v-if="roles.hasRoleSuperadmin" class="text-xl sm:text-sm" href="/settings">
                <div class="mr-2 w-8 h-8 flex items-center justify-center text-center">
                    <img alt="" class="mx-auto inline-block w-5 h-5" src="/images/setting.svg"/>
                </div>
                <span class="text-xl sm:text-sm my-auto">Setting</span>
            </xylo-nav-link>
        </div>
    </div>
</template>
<script>
import XyloNavLink from "@/Components/NavLink.vue";

export default {
    props: {
        roles: {
            type: Object,
            default: function () {
                return this.$page.props.roles;
            }
        },

        permissions: {
            type: Object,
            default: function () {
                return this.$page.props.permissions;
            }
        },

        group_dealers_menu: {
            type: Array,
            default: function () {
                return this.$page.props.group_dealers_menu;
            }
        },
        activities_menu: {
            type: Array,
            default: function () {
                return this.$page.props.activities_menu;
            }
        },
        auth: {
            type: Object,
            default: function () {
                return this.$page.props.auth
            }
        },
        features: {
            type: Object,
            default: function () {
                return this.$page.props.features;
            }
        },
    },

    components: {
        XyloNavLink
    },

    data() {
        return {
            showLeads: window.location.href.includes("leads"),
            showDashboard: window.location.href.includes("dashboard"),
            showBasicActivity: window.location.href.includes("/dashboard/basic-activity"),
            showActivities: window.location.href.includes("activity"),
            showRolePermission: window.location.href.includes("roles") || window.location.href.includes("permissions"),
            showGroupDealer: window.location.href.includes("group-dealer"),
            showGroupDealerSummary: [],
            showGroupDealerInsight: [],
            showGroupProduct: window.location.href.includes("/cms/products"),
            showGroupActivity: window.location.href.includes("/cms/activities"),
            showDataValidation: window.location.href.includes("data-validation"),
            showGarage: window.location.href.includes("summary") || window.location.href.includes("insight"),
            showGroupSales: window.location.href.includes("spk-target"),
            showGroupReport: window.location.href.includes("report/"),
            showSystemManagement: window.location.href.includes("cms") || window.location.href.includes("spk-target"),
            showNationalEvent: window.location.href.includes('national-events'),
            showFunneling: window.location.href.includes('funneling'),
            desktop_menu: [
                {
                    title: "Dashboard",
                    icon: "dashboard-icon (1).svg",
                    icon_fill: "dashboard-icon.svg",
                    slug: "",
                    menudropdown: "dashboard",
                    isDropdown: true,
                    canAccess: this.permissions.AccessConversion || this.permissions.AccessWsRs || this.permissions.AccessStock || this.permissions.AccessManpower || this.permissions.AccessInsight || this.permissions.DashboardGroupDealer ||
                        this.permissions.DashboardMarketingActivity ||
                        this.permissions.DashboardEndToEnd ||
                        this.permissions.DashboardSummary ||
                        this.permissions.DashboardProspect ||
                        this.permissions.DashboardOm ||
                        this.permissions.DashboardOccupation ||
                        this.permissions.DashboardComparison ||
                        this.permissions.DashboardTd ||
                        this.permissions.DashboardSpk  ||
                        this.permissions.DashboardPaymentLeasing ||
                        this.permissions.DashboardDo ||
                        this.permissions.DashboardDoColor ||
                        this.permissions.DashboardFunnelBreakdown  ||
                        this.permissions.DashboardUser  ||
                        this.auth.user.role.name == "superadmin",
                    listDropdown: [
                        {
                            title: "Conversion",
                            icon: "dot.svg",
                            slug: "dashboard.conversion",
                            canAccess: this.permissions.AccessConversion || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "WS & RS",
                            icon: "dot.svg",
                            slug: "dashboard.wholesales",
                            canAccess: this.permissions.AccessWsRs || this.auth.user.role.name == "superadmin"
                        },
                        // {
                        //     title: "Stock",
                        //     icon: "dot.svg",
                        //     slug: "dashboard.stock",
                        //     canAccess: this.permissions.AccessStock
                        // },
                        {
                            title: "Manpower",
                            icon: "dot.svg",
                            slug: "dashboard.manpower",
                            canAccess: this.permissions.AccessManpower || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Insight",
                            icon: "dot.svg",
                            slug: "dashboard.insight",
                            canAccess: this.permissions.AccessInsight || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Group Dealer",
                            dropdownsub: "group-dealer",
                            icon: "dot.svg",
                            isDropdown: true,
                            canAccess: (this.auth.user.role.name !== "group-dealer" ? this.permissions.DashboardGroupDealer : false) || this.auth.user.role.name == "superadmin",
                            listDropdown: this.group_dealers_menu
                        },
                        {
                            title: "Funneling",
                            dropdownsub: "funneling",
                            icon: "dot.svg",
                            isDropdown: true,
                            canAccess: (this.permissions.DashboardMarketingActivity ||
                                this.permissions.DashboardEndToEnd ||
                                this.permissions.DashboardSummary ||
                                this.permissions.DashboardProspect ||
                                this.permissions.DashboardOm ||
                                this.permissions.DashboardOccupation ||
                                this.permissions.DashboardComparison ||
                                this.permissions.DashboardTd ||
                                this.permissions.DashboardSpk  ||
                                this.permissions.DashboardLeasing ||
                                this.permissions.DashboardDo ||
                                this.permissions.DashboardDoColor ||
                                this.permissions.DashboardFunnelBreakdown  ||
                                this.permissions.DashboardUser) || this.auth.user.role.name == "superadmin",
                            listDropdown: [
                                {
                                    title: "Marketing Activity",
                                    icon: "dot.svg",
                                    slug: "dashboard.marketing-activity",
                                    canAccess: this.permissions.DashboardMarketingActivity || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "End To End",
                                    icon: "dot.svg",
                                    slug: "dashboard.end-to-end",
                                    canAccess: this.permissions.DashboardEndToEnd || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "Summary",
                                    icon: "dot.svg",
                                    slug: "dashboard.summary",
                                    canAccess: this.permissions.DashboardSummary || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "Prospect",
                                    icon: "dot.svg",
                                    slug: "dashboard.prospect",
                                    canAccess: this.permissions.DashboardProspect || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "OM",
                                    icon: "dot.svg",
                                    slug: "dashboard.om",
                                    canAccess: this.permissions.DashboardOm || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "Occupation",
                                    icon: "dot.svg",
                                    slug: "dashboard.occupation",
                                    canAccess: this.permissions.DashboardOccupation || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "Comparison",
                                    icon: "dot.svg",
                                    slug: "dashboard.comparison",
                                    canAccess: this.permissions.DashboardComparison || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "Test Drive",
                                    icon: "dot.svg",
                                    slug: "dashboard.td",
                                    canAccess: this.permissions.DashboardTd || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "SPK",
                                    icon: "dot.svg",
                                    slug: "dashboard.spk",
                                    canAccess: this.permissions.DashboardSpk  || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "Payment Leasing",
                                    icon: "dot.svg",
                                    slug: "dashboard.payment-leasing",
                                    canAccess: this.permissions.DashboardPaymentLeasing || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "Delivery Order",
                                    icon: "dot.svg",
                                    slug: "dashboard.do",
                                    canAccess: this.permissions.DashboardDo || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "DO Color",
                                    icon: "dot.svg",
                                    slug: "dashboard.do-color",
                                    canAccess: this.permissions.DashboardDoColor || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "Funnel Breakdown ",
                                    icon: "dot.svg",
                                    slug: "dashboard.funnel-breakdown",
                                    canAccess: this.permissions.DashboardFunnelBreakdown  || this.auth.user.role.name == "superadmin"
                                },
                                {
                                    title: "User ",
                                    icon: "dot.svg",
                                    slug: "dashboard.user",
                                    canAccess: this.permissions.DashboardUser  || this.auth.user.role.name == "superadmin"
                                }
                            ]
                        },
                        // {
                        //     title: "Activity",
                        //     icon: "dot.svg",
                        //     slug: "",
                        //     dropdownsub: "Activities",
                        //     isDropdown: true,
                        //     canAccess: this.permissions.BasicActivity || this.auth.user.role.name == "superadmin",
                        //     listDropdown: [
                        //         {
                        //             title: "Basic",
                        //             slug: "basic-activity.index"
                        //         },
                        //     ]
                        // },
                    ]
                },
                {
                    title: "Activity",
                    icon: "dashboard-icon (1).svg",
                    icon_fill: "dashboard-icon.svg",
                    slug: "",
                    menudropdown: "activity",
                    isDropdown: true,
                    canAccess: (this.features.activity || this.features.special_activity) && (this.permissions.AccessActivities || this.permissions.BasicActivity || this.permissions.AccessSpecialActivity || this.auth.user.role.name == "superadmin"),
                    listDropdown: [
                        {
                            title: "Basic",
                            icon: "dot.svg",
                            slug: "basic-activity.index",
                            canAccess: this.permissions.BasicActivity || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Special",
                            icon: "dot.svg",
                            slug: "special.activity.list",
                            canAccess: this.features.special_activity && (this.permissions.AccessSpecialActivity || this.auth.user.role.name == "superadmin")
                        }
                    ]
                },
                {
                    title: "National Event",
                    icon: "national-event.svg",
                    icon_fill: "national-event.svg",
                    slug: "",
                    menudropdown:"nationalEvent",
                    isDropdown: true,
                    canAccess: this.features.national_event && (this.permissions.AccessTestDriveNationalEvent || this.permissions.AccessNationalEvent || this.permissions.AccessReportSalesNationalEvent || this.auth.user.role.name == "superadmin" || this.auth.user.role.name == "admin-eo-test-drive-luar" || this.auth.user.role.name == "admin-eo-test-drive-dalam"),
                    listDropdown: [
                            {
                                title: "Report Leads",
                                icon: "dot.svg",
                                slug: "national-event.report.sales",
                                canAccess: this.auth.user.role.name == "superadmin" || this.permissions.AccessReportSalesNationalEvent
                            },
                            {
                                title: "Setup Sales",
                                icon: "dot.svg",
                                slug: "national-event.list",
                                canAccess: this.auth.user.role.name == "superadmin" || this.auth.user.role.name == 'area-manager-spv'
                            },
                            {
                                title: "Test Drive",
                                icon: "dot.svg",
                                slug: "national-event.test-drive.index",
                                canAccess: this.auth.user.role.name == "superadmin" || this.auth.user.role.name == "admin-eo-test-drive-luar" || this.auth.user.role.name == "admin-eo-test-drive-dalam" || this.permissions.AccessTestDriveNationalEvent
                            },
                            {
                                title: "SPK",
                                icon: "dot.svg",
                                slug: "national-event.spk.list",
                                canAccess: this.auth.user.role.name == "superadmin" || this.permissions.AccessSPKNationalEvent
                            },
                            {
                                title: "Top 10 GIIAS 2023",
                                icon: "dot.svg",
                                param: 1,
                                slug: "national-event.report.top-list",
                                canAccess: this.auth.user.role.name == "superadmin" || this.auth.user.role.name == "area-manager-spv"
                            },
                            {
                                title: "Top IIMS 2024",
                                icon: "dot.svg",
                                param: 25,
                                slug: "national-event.report.top-list-iims",
                                canAccess: this.auth.user.role.name == "superadmin" || this.auth.user.role.name == "area-manager-spv"
                            },
                            {
                                title: "Top GIIAS 2024",
                                icon: "dot.svg",
                                param: 37,
                                slug: "national-event.report.top-list-giias2024",
                                canAccess: this.auth.user.role.name == "superadmin" || this.auth.user.role.name == "area-manager-spv"
                            }
                        ]
                },
                {
                    title: "System Management",
                    icon: "system_mgmt-icon.svg",
                    icon_fill: "network.svg",
                    slug: "",
                    menudropdown: "systemmanagement",
                    isDropdown: true,
                    canAccess:
                        this.permissions.AccessSales ||
                        this.permissions.AccessIncentive ||
                        this.permissions.AccessNotifications ||
                        this.permissions.AccessRewards ||
                        this.permissions.AccessPromotionTools ||
                        this.permissions.AccessProduct ||
                        this.permissions.AccessUsers ||
                        this.permissions.AccessRolePermission ||
                        this.permissions.AccessOccupation ||
                        this.permissions.AccessDealer ||
                        this.permissions.AccessCity ||
                        this.permissions.AccessSource ||
                        this.permissions.AccessChannel ||
                        this.permissions.AccessForm ||
                        this.permissions.AccessSalesStock ||
                        this.permissions.SPKTargetDealer ||
                        this.permissions.SPKTargetGroupDealer ||
                        this.permissions.AccessSalesPeople ||
                        this.permissions.AccessWholesales ||
                        this.permissions.AccessDmsApi ||
                        this.permissions.CMSGroupDealer ||
                        this.permissions.CMSNationalEvent ||
                        this.permissions.AccessProvince ||
                        this.permissions.AccessCustomerType ||
                        this.permissions.AccessEducationLevel ||
                        this.permissions.AccessCmsDigitalAsset ||
                        this.auth.user.role.name == "superadmin",
                    listDropdown: [
                        {
                            title: "SPK Target",
                            icon: "graph-up.svg",
                            slug: "",
                            dropdownsub: "group-sales",
                            isDropdown: true,
                            canAccess: /*(this.auth.user.role.name !== "superadmin" && this.permissions.AccessSalesStock) || */(this.auth.user.role.name == "superadmin" || this.permissions.SPKTargetDealer) || (this.auth.user.role.name == "superadmin" || this.permissions.SPKTargetGroupDealer) || (this.auth.user.role.name == "superadmin" || this.permissions.AccessSalesPeople),
                            listDropdown: [
                                /*{
                                    title: "Stock",
                                    icon: "report.svg",
                                    slug: "stocks.index",
                                    canAccess: this.auth.user.role.name !== "superadmin" ? this.permissions.AccessSalesStock : false
                                },*/
                                {
                                    title: "Group Dealer Target",
                                    icon: "report.svg",
                                    slug: "sales.target-group.groupdealer",
                                    canAccess: this.auth.user.role.name == "superadmin" || this.permissions.SPKTargetGroupDealer
                                },
                                {
                                    title: "Dealer Target",
                                    icon: "report.svg",
                                    slug: "sales.target.groupdealer2",
                                    canAccess: this.auth.user.role.name == "superadmin" || this.permissions.SPKTargetDealer
                                },
                                {
                                    title: "Salespeople Target",
                                    icon: "report.svg",
                                    slug: "sales.people.pic-dealer2",
                                    canAccess: this.auth.user.role.name === "superadmin" || this.permissions.AccessSalesPeople
                                }
                            ]
                        },
                        {
                            title: "National Event",
                            icon: "national-event.svg",
                            slug: "cms.national-event.index",
                            canAccess: this.features.national_event && (this.permissions.CMSNationalEvent || this.auth.user.role.name == "superadmin")
                        },
                        {
                            title: "Merchandise",
                            icon: "",
                            slug: "merchandise.index",
                            canAccess: this.permissions.AccessMerchandise || this.auth.user.role.name == "superadmin"
                        },
                        // {
                        //     title: "Weekly Control Setting",
                        //     icon: "weekly.svg",
                        //     slug: "weekly-control-setting.index",
                        //     canAccess: this.permissions.AccessDmsApi || this.auth.user.role.name == "superadmin"
                        // },
                        {
                            title: "WSA",
                            icon: "dealer.svg",
                            slug: "wholesales.index",
                            canAccess: this.permissions.AccessDmsApi || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Incentive",
                            icon: "incentive.svg",
                            slug: "incentives.index",
                            canAccess: this.features.cms_incentive && (this.permissions.AccessIncentive || this.auth.user.role.name == "superadmin")
                        },
                        {
                            title: "Notifications",
                            icon: "notification.svg",
                            slug: "notifications.templates.index",
                            canAccess: this.permissions.AccessNotifications || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Rewards",
                            icon: "reward.svg",
                            slug: "rewards.list",
                            canAccess: this.permissions.AccessRewards || this.auth.user.role.name == "superadmin"
                        },
                        /* {
                            title: "Promotion Tools",
                            icon: "brochure.svg",
                            slug: "brochures.index",
                            canAccess: this.permissions.AccessPromotionTools || this.auth.user.role.name == "superadmin"
                        }, */
                        {
                            title: "Brochure",
                            icon: "brochure.svg",
                            slug: "brochures.index",
                            canAccess: this.permissions.AccessCmsBrochure || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Digital Asset",
                            icon: "brochure.svg",
                            slug: "digital-assets.index",
                            canAccess: this.permissions.AccessCmsDigitalAsset || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Name Card",
                            icon: "brochure.svg",
                            slug: "namecard.index",
                            canAccess: this.permissions.AccessCmsNamecard || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Product",
                            icon: "product.svg",
                            slug: "",
                            dropdownsub: "groupProduct",
                            isDropdown: true,
                            canAccess: this.permissions.AccessProduct || this.auth.user.role.name == "superadmin",
                            listDropdown: [
                                {
                                    title: "List",
                                    slug: "products.index"
                                },
                                {
                                    title: "Category",
                                    slug: "product.categories.index"
                                },
                                {
                                    title: "Fuel Category",
                                    slug: "product.FuelCategories.index"
                                },
                                {
                                    title: "Color",
                                    slug: "product.colors.index"
                                },
                                {
                                    title: "Model",
                                    slug: "product.series.index"
                                },
                                {
                                    title: "Series",
                                    slug: "product.types.index"
                                }
                            ]
                        },
                        {
                            title: "Activity",
                            icon: "dealer.svg",
                            slug: "",
                            dropdownsub: "groupActivity",
                            isDropdown: true,
                            canAccess: this.features.activity && (this.permissions.CMSActivity || this.auth.user.role.name === "superadmin"),
                            listDropdown: [
                                {
                                    title: "Category",
                                    slug: "activity-type-category.index"
                                },
                                {
                                    title: "Type",
                                    slug: "activity-type.index"
                                },
                                {
                                    title: "Budget Setting",
                                    slug: "activity-budget.index"
                                },
                            ]
                        },

                        {
                            title: "Users",
                            icon: "users.svg",
                            slug: "accounts.index",
                            canAccess: this.permissions.AccessUsers || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Role & Permission",
                            icon: "role.svg",
                            dropdownsub: "rolepermission",
                            isDropdown: true,
                            canAccess: this.permissions.AccessRolePermission || this.auth.user.role.name == "superadmin",
                            listDropdown: [
                                {
                                    title: "Permission List",
                                    slug: "permissions.index"
                                },
                                {
                                    title: "Role List",
                                    slug: "roles.index"
                                }
             ,               ]
                        },
                        {
                            title: "Occupation",
                            icon: "occupations.svg",
                            slug: "occupations.index",
                            canAccess: this.permissions.AccessOccupation || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Group Dealer",
                            icon: "dealer.svg",
                            slug: "group_dealers.index",
                            canAccess: this.permissions.CMSGroupDealer || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Dealer",
                            icon: "dealer.svg",
                            slug: "dealers.index",
                            canAccess: this.permissions.AccessDealer || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "City",
                            icon: "city.svg",
                            slug: "cities.index",
                            canAccess: this.permissions.AccessCity || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Source",
                            icon: "source.svg",
                            slug: "sources.index",
                            canAccess: this.permissions.AccessSource || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Leasing",
                            icon: "source.svg",
                            slug: "leasings.index",
                            canAccess: this.permissions.CMSLeasing || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Channel",
                            icon: "source.svg",
                            slug: "channels.index",
                            canAccess: this.permissions.AccessChannel || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Form",
                            icon: "source.svg",
                            slug: "forms.index",
                            canAccess: this.permissions.AccessForm || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Dummy Leads",
                            icon: "source.svg",
                            slug: "dummy_prospects.index",
                            canAccess: this.permissions.AccessDummyProspect || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Province",
                            icon: "source.svg",
                            slug: "provinces.index",
                            canAccess: this.permissions.AccessProvince || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Customer Type",
                            icon: "source.svg",
                            slug: "customer-types.index",
                            canAccess: this.permissions.AccessCustomerType || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Education Level",
                            icon: "source.svg",
                            slug: "education-levels.index",
                            canAccess: this.permissions.AccessEducationLevel || this.auth.user.role.name == "superadmin"
                        }
                    ]
                },
                {
                    title: "Data Validation",
                    icon: "datavalidation-icon.svg",
                    icon_fill: "datavalidation-icon (1).svg",
                    slug: "",
                    menudropdown: "dataValidation",
                    isDropdown: true,
                    canAccess:
                        this.permissions.AccessTDValidation ||
                        this.permissions.AccessSPKValidation ||
                        this.permissions.AccessDOValidation ||
                        this.permissions.AccessRedeemValidation ||
                        this.auth.user.role.name == "superadmin",
                    listDropdown: [
                        {
                            title: "Test Drive",
                            icon: "dot.svg",
                            slug: "data-validation.testdrive",
                            canAccess: this.permissions.AccessTDValidation || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "SPK",
                            icon: "dot.svg",
                            slug: "data-validation.spk",
                            canAccess: this.permissions.AccessSPKValidation || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "DO",
                            icon: "dot.svg",
                            slug: "data-validation.do",
                            canAccess: this.permissions.AccessDOValidation || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Redeem",
                            icon: "dot.svg",
                            slug: "data-validation.redeems",
                            canAccess: this.permissions.AccessRedeemValidation || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Advanced RS",
                            icon: "dot.svg",
                            slug: "data-validation.advanced-rs",
                            canAccess: this.auth.user.role.name == "superadmin"
                        }
                    ]
                },
                {
                    title: "Report",
                    icon: "report-icon.svg",
                    icon_fill: "report-icon.svg",
                    slug: "",
                    menudropdown: "group-report",
                    isDropdown: true,
                    canAccess:
                        this.permissions.AccessTestDriveReport ||
                        this.permissions.AccessSPKReport ||
                        this.permissions.AccessDOReport ||
                        this.permissions.AccessProspectReport ||
                        // this.permissions.AccessCustomerReport ||
                        this.permissions.AccessIncentiveReport ||
                        this.permissions.AccessRewardReport ||
                        this.permissions.AccessHistoryPoint ||
                        this.permissions.AccessBranchManager ||
                        this.auth.user.role.name == "superadmin",
                    listDropdown: [
                        {
                            title: "Test Drive Data",
                            icon: "",
                            slug: "testdrive.report",
                            canAccess: this.permissions.AccessTestDriveReport || this.permissions.AccessBranchManager || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "SPK Data",
                            icon: "",
                            slug: "spk.report",
                            canAccess: this.permissions.AccessSPKReport || this.permissions.AccessBranchManager || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "DO Data",
                            icon: "",
                            slug: "do.report",
                            canAccess: this.permissions.AccessDOReport || this.permissions.AccessBranchManager || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Leads Data",
                            icon: "",
                            slug: "prospect.report",
                            canAccess: this.permissions.AccessProspectReport || this.permissions.AccessBranchManager || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "End to End Data",
                            icon: "",
                            slug: "huluHilir.report",
                            canAccess: this.permissions.AccessEndToEndReport || this.auth.user.role.name == "superadmin"
                        },

                        // {
                        //     title: "Customer Data",
                        //     icon: "",
                        //     slug: "customer.report",
                        //     canAccess: this.permissions.AccessCustomerReport || this.permissions.AccessBranchManager || this.auth.user.role.name == "superadmin"
                        // },
                        {
                            title: "Incentive",
                            icon: "",
                            slug: "incentive.report",
                            canAccess: this.features.incentive_report && (this.permissions.AccessIncentiveReport || this.auth.user.role.name == "superadmin")
                        },
                        {
                            title: "Reward Redemption",
                            icon: "",
                            slug: "redeem.report",
                            canAccess: this.permissions.AccessRewardReport || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "History Point",
                            icon: "",
                            slug: "points.history",
                            canAccess: this.permissions.AccessHistoryPoint || this.auth.user.role.name == "superadmin"
                        },
                        {
                            title: "Edit Report Date",
                            icon: "",
                            slug: "edit-report-date.index",
                            canAccess: this.permissions.EditReportDate && this.auth.user.role.name == "superadmin"
                        },
						{
                            title: "Report Logs",
                            icon: "",
                            slug: "report.log.index",
                            canAccess: this.$page.props.usergroup.export.request.includes(this.auth.user.role.name)
                        },
						{
                            title: "Digital Assets",
                            icon: "",
                            slug: "digital-assets.report",
                            canAccess: this.auth.user.role.name == "superadmin" || this.auth.user.role.name == "admin-digital-media"
                        },
                    ]
                },
              /*   {
                    title: "Logs",
                    icon: "logs.svg",
                    icon_fill: "logs_fill.svg",
                    slug: "activity.logs.index",
                    canAccess: false || this.auth.user.role.name == "superadmin"
                } */
            ]
        };
    },

    methods: {
        openMenu(param) {
            if (param === "leads") {
                return this.showLeads;
            } else if (param === "dashboard") {
                return this.showDashboard;
            } else if (param === "activity") {
                return this.showActivities;
            } else if (param === "rolepermission") {
                return this.showRolePermission;
            }  else if (param === "group-dealer") {
                return this.showGroupDealer;
            } else if (param === "funneling") {
                return this.showFunneling;
            } else if (param === "garage") {
                return this.showGarage;
            } else if (param === "groupProduct") {
                return this.showGroupProduct;
            }
            else if (param === "groupActivity") {
                return this.showGroupActivity;
            }
            else if (param === "group-sales") {
                return this.showGroupSales;
            } else if (param === "systemmanagement") {
                return this.showSystemManagement;
            } else if (param === "group-report") {
                return this.showGroupReport;
            } else if (param === "dataValidation") {
                return this.showDataValidation;
            } else if (this.group_dealers_menu.find(o => o.dropdownsub === param)) {
                return this.showGroupDealerSummary[param] || this.showGroupDealerInsight[param];
            } else if (param === 'nationalEvent') {
                return this.showNationalEvent;
            }
            else if (param === "Activities") {
                return this.showBasicActivity;
            }
        },

        dropdown(param) {
            if (param == "notification") {
                this.showPN = !this.showPN;
            } else if (param == "dashboard") {
                this.showDashboard = !this.showDashboard;
            } else if (param == "activity") {
                this.showActivities = !this.showActivities;
            } else if (param == "rolepermission") {
                this.showRolePermission = !this.showRolePermission;
            } else if (param == "group-dealer") {
                this.showGroupDealer = !this.showGroupDealer;
            } else if (param == "funneling") {
                this.showFunneling = !this.showFunneling;
            } else if (param == "garage") {
                this.showGarage = !this.showGarage;
            } else if (param == "groupProduct") {
                this.showGroupProduct = !this.showGroupProduct;
            }
            else if (param == "groupActivity") {
                this.showGroupActivity = !this.showGroupActivity;
            }
            else if (param === "group-sales") {
                this.showGroupSales = !this.showGroupSales;
            } else if (param == "systemmanagement") {
                this.showSystemManagement = !this.showSystemManagement;
            } else if (param == "group-report") {
                this.showGroupReport = !this.showGroupReport;
            } else if (param == "dataValidation") {
                this.showDataValidation = !this.showDataValidation;
            } else if (this.group_dealers_menu.find(o => o.dropdownsub === param)) {
                this.$set(this.showGroupDealerSummary, param, !this.showGroupDealerSummary[param])
                this.$set(this.showGroupDealerInsight, param, !this.showGroupDealerInsight[param])
            } else if (param == "nationalEvent") {
                this.showNationalEvent = !this.showNationalEvent;
            }
            else if (param == "Activities") {
                this.showBasicActivity = !this.showBasicActivity;
            }
        },

        // logout() {
        //     this.$inertia.post(route("custom.logout"));
        // },
        async logout() {
            await axios.post(route('custom.logout')).then(function (res){
               return window.location.href = '/login'
            });
            // this.$inertia.post(route('custom.logout'));
        },

        getActiveRoute(slug, param) {
            if (slug === 'dashboard.groupdealer.summary') {
                var url = this.$page.url.includes('summary/' + param)
            } else {
                var url = this.$page.url.includes('insight/' + param)
            }
            return url
        },

        isClicked() {
            this.$emit('isRedirect');
        }
    },
    mounted() {
        if (this.$page.url.includes('summary')) {
            this.group_dealers_menu.forEach(element => {
                this.$set(this.showGroupDealerSummary, element.dropdownsub, this.$page.url.includes('summary/' + element.dropdownsub))
            })
        }
        if (this.$page.url.includes('insight')) {
            this.group_dealers_menu.forEach(element => {
                this.$set(this.showGroupDealerInsight, element.dropdownsub, this.$page.url.includes('insight/' + element.dropdownsub))
            })
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
