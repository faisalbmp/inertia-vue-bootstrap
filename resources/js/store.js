import { reactive } from 'vue';

export const state = reactive({
    user: null,
    roles: [],
});

export const setUser = (user) => {
    state.user = user;
};

export const setRoles = (roles) => {
    state.roles = roles;
};
