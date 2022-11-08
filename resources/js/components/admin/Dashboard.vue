<template>
    <!-- App.vue -->
    <!-- <v-app id="inspire"> -->
    <v-app id="app">
        <v-navigation-drawer v-model="drawer" app fixed temporary>
            <v-sheet
                style="background-color: blue"
                color="blue darken-1"
                class="pa-8 overflow-hidden"
                absolute
                temporary
            >
                <!-- <v-avatar class="mb-4" color="grey darken-1" size="64"> -->
                </v-avatar>
            </v-sheet>
            <v-divider></v-divider>

            <v-list>
                <v-list-item to="/planning" link>
                    <v-list-item-icon>
                        <v-icon  color="purple darken-2">
                            mdi-dialpad
                        </v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title
                            style="font-weight: bold; font-size: 15px"
                            >Dashboard</v-list-item-title
                        >
                    </v-list-item-content>
                </v-list-item>

                <v-list-item to="/details" link>
                    <v-list-item-icon>
                        <v-icon  color="teal darken-2"> mdi-phone </v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title
                            style="font-weight: bold; font-size: 15px"
                            >Add Details</v-list-item-title
                        >
                    </v-list-item-content>
                </v-list-item>

                <v-list-item to="/users" link>
                    <v-list-item-icon>
                        <v-icon  color="teal darken-2"> mdi-email </v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title
                            style="font-weight: bold; font-size: 15px"
                            >Add Users</v-list-item-title
                        >
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app dense color="light" class="pa-0">
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title class="font-weight-bold text--sm"
                >MINISTRY OF SPORT STATISTICS</v-toolbar-title
            >
            <v-spacer></v-spacer>
            <v-icon dark class="blue--text"> mdi-account-circle </v-icon>
            {{ username }}
            <div class="ml-1">
                <v-tooltip left>
                    <template v-slot:activator="{ on, attrs }">
                        <v-icon
                            block
                            @click="logout"
                            color="blue"
                            v-bind="attrs"
                            v-on="on"
                        >
                            mdi-logout-variant
                        </v-icon>
                    </template>
                    <span>log Out</span>
                </v-tooltip>
            </div>
            <!-- -->
        </v-app-bar>
        <!-- Sizes your content based upon application components -->
        <v-main>
            <!-- Provides the application the proper gutter -->
            <v-container fluid>
                <!-- If using vue-router -->
                <router-view></router-view>
            </v-container>
        </v-main>

        <v-footer app dense dark>
            <!-- -->
            <img
                src="/img/celata_logo.jpg"
                width="60"
                height="15"
                class="align-right"
            />
        </v-footer>
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            drawer: null,
            username: null,
        };
    },
    mounted() {
        let user = localStorage.getItem("user");
        if (!user) {
            this.logout();
        } else {
            user = JSON.parse(user);
            console.log("user", user);
            this.username = user.name;
        }
    },

    methods: {
        logout() {
            localStorage.removeItem("token");
            localStorage.removeItem("user");
            window.setLogout();
        },
    },
};
</script>
