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
import LeftArrow from "@/Components/Icons/LeftArrow.vue";

export default {
    name: "BackButton",

    components: {
        LeftArrow
    },

    props: {
        to: {
            type: String,
            default: ""
        },
        pages: {
            type: String,
            default: ""
        }
    },

    methods: {
        historyBack() {
            if(this.to && this.pages === 'sales-followups-show'){
                if(this.to === '/login' || this.to === '/dashboard'){
                    this.$inertia.get(route('followups.index'))
                }else{
                    window.history.back()
                }
            }else if(this.pages === 'sales-followups-show'){
                this.$inertia.get(route('followups.index'))
            }
            else if(this.to){
                    this.$inertia.get(this.to)
            }
            else{
                window.history.back()
            }
            // this.to ? this.$inertia.get(this.to) : window.history.back();
        }
    }
};
</script>
