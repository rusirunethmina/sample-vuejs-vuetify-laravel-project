<template>
    <div id="app">
        <v-app>
            <v-main
                id="loginPage"
                style="
                    background-repeat: no-repeat !important;
                    background-size: auto;
                    background-position: center;
                    background-color: #6082B6;
                "
            >
                <v-container class="fill-height" fluid>
                    <v-row align="center" justify="center">
                        <v-col cols="12" sm="8" md="4" xs="12" lg="4" xl="4">
                            <v-card
                                style="background-color: rgba(255, 255, 255, 1)"
                                class="mx-auto rounded- align-center text-center"
                                tile
                            >
                                <v-row class="mt-0 pt-0">
                                    <v-col cols="12" class="mt-0 pt-0">
                                        <v-flex class="text-center mt-0 pt-0">
                                            <v-card-title
                                                class="justify-center mb-1"
                                                style="
                                                    background-color: #003958;
                                                "
                                            >
                                            </v-card-title>

                                            <h3>WELCOME MINISTRY OF SPORTS STATISTICS</h3>
                                        </v-flex>
                                    </v-col>
                                </v-row>

                                <v-card-text>
                                    <v-form
                                        v-model="valid"
                                        ref="form"
                                        action="login"
                                        method="post"
                                    >
                                        <v-text-field
                                            name="_token"
                                            :value="csrf"
                                            v-model="csrf"
                                            v-show="false"
                                        ></v-text-field>
                                        <v-text-field
                                            label="Enter your e-mail address"
                                            v-model="email"
                                            :value="email"
                                            name="email"
                                            dense
                                            outlined
                                            :error-messages="email_errors"
                                            :rules="emailRules"
                                            required
                                        ></v-text-field>
                                        <v-text-field
                                            label="Enter your password"
                                            v-model="password"
                                            :value="password"
                                            name="password"
                                            :error-messages="password_errors"
                                            outlined
                                            dense
                                            min="8"
                                            :append-icon="
                                                e1
                                                    ? 'visibility'
                                                    : 'visibility_off'
                                            "
                                            @click:append="e1 = !e1"
                                            :type="e1 ? 'text' : 'password'"
                                            :rules="passwordRules"
                                            required
                                        ></v-text-field>
                                        <!--<v-checkbox
                                            v-model="rememberMe"
                                            :value="rememberMe"
                                            dense
                                            name="remember"
                                            id="remember"
                                            label="Remember Me"
                                        ></v-checkbox>-->
                                        <v-btn
                                            class="white--text"
                                            small
                                            block
                                            :loading="cardLoader"
                                            @click="submit"
                                            color="blue"
                                            >Sign Me In</v-btn
                                        >

                                        <v-layout> </v-layout>
                                    </v-form>
                                </v-card-text>
                                <v-row class="mt-4">
                                    <v-list-item-title
                                        class="overline"
                                        style="
                                            text-align: center;
                                            font-weight: bolder !important;
                                            color: gray !important;
                                            font-size: 8px !important;
                                        "
                                    > 
                                        <!-- Powerd by Celata -->
                                    </v-list-item-title>
                                </v-row>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>
            </v-main>
        </v-app>
    </div>
</template>
<script>
export default {
    name: "api-login",
    component: {},
    data() {
        return {
            window: {
                width: 0,
                height: 0,
            },
            snackbar: false,
            snackColor: "",
            snackMessage: "",
            snackBarRight: false,
            snackBarTop: false,
            valid: false,
            e1: false,
            password: "",
            passwordRules: [(v) => !!v || "Password is required"],
            emailRules: [
                (v) => !!v || "E-mail is required",
                (v) =>
                    /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/.test(v) ||
                    "E-mail must be valid",
            ],
            csrf: "",
            email_errors: [],
            password_errors: [],
            cardLoader: false,
            socialLoader: false,
            email: "",
            name: "",
            mobile: "",
            address: "",
            avatar: "",
            myLocation: {
                lat: "",
                lng: "",
            },
            randomPassword: "Abcdef@123",
            header: {},
            rememberMe: false,
            user_id: null,
            user_type: null,
            officer_id: null,
            section: null,
        };
    },
    beforeDestroy() {
        clearInterval(this.interval);
    },
    destroyed() {
        window.removeEventListener("resize", this.handleResize);
    },
    mounted() {
        let laravel = JSON.parse(window.Laravel);
        this.csrf = laravel.csrfToken;
        this.header = {
            "X-CSRF-TOKEN": this.csrf,
            "X-Requested-With": "XMLHttpRequest",
            "content-type": "multipart/form-data",
        };
        let user = laravel.user;
    },
    computed: {},
    watch: {},
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    methods: {
        //---------------------------Handling the user window resize event--------------------------------
        handleResize() {
            this.window.width = window.innerWidth;
            this.window.height = window.innerHeight;
        },
        submit() {
            if (this.$refs.form.validate()) {
                this.checkUserLogin();
            }
        },
        clear() {
            this.$refs.form.reset();
        },
        goBack() {
            this.$router.back();
        },
        //------------check user login------------------------------------------------
        checkUserLogin() {
            this.cardLoader = true;

            axios
                .post(
                    "/api/checkLogin",
                    { email: this.email, password: this.password },
                    this.header
                )
                .then((response) => {
                    this.cardLoader = false;
                    if (response.data.validate == "success") {
                        this.snackMessage = "Login successful.Redirecting...";
                        this.snackColor = "success";
                        this.snackBarTop = true;
                        this.snackbar = true;
                        localStorage.setItem(
                            "user",
                            JSON.stringify(response.data.user)
                        );

                        localStorage.setItem(
                            "token",
                            response.data.access_token
                        );
                        this.$refs.form.$el.submit();
                    } else if (response.data.validate == "invalid_email") {
                        this.snackMessage = "Invalid Email";
                        this.snackColor = "error";
                        this.snackBarTop = true;
                        this.snackbar = true;

                        this.password = "";
                        this.email_errors = [
                            "we cannot find user with this email",
                        ];
                    } else if (response.data.validate == "invalid_password") {
                        this.snackMessage = "Authentication fail";
                        this.snackColor = "error";
                        this.snackBarTop = true;
                        this.snackbar = true;

                        this.password = "";
                        this.password_errors = [
                            "invalid password.try forget password",
                        ];
                    } else {
                        this.snackMessage = response.data.validate;
                        this.snackColor = "error";
                        this.snackBarTop = true;
                        this.snackbar = true;
                        this.password = "";
                    }
                })

                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
