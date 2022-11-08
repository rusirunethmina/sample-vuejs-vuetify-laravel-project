<template>
    <v-app>
        <div>
            <v-container fluid>
                <v-form @Submit.prevent ref="form" lazy-validation>
                    <v-row>
                        <v-col cols="12" sm="6" md="3">
                            <v-text-field
                                label="User Name"
                                v-model="UserData.name"
                                solo
                                :rules="[(v) => !!v || 'User Name is required']"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-text-field
                                label="E-mail"
                                solo
                                v-model="UserData.email"
                                :rules="[(v) => !!v || 'E-mail is required']"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-text-field
                                label="Address"
                                solo
                                v-model="UserData.address"
                                :rules="[(v) => !!v || 'Address is required']"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-text-field
                                label="Mobile"
                                solo
                                v-model="UserData.mobile"
                                :rules="[
                                    (v) => !!v || 'Mobile Number is required',
                                ]"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="4" sm="4" md="4">
                            <v-btn
                                class="mb-4"
                                color="primary"
                                @click="add_users()"
                                dark
                            >
                                Submit
                            </v-btn>
                            <v-btn
                                color="red"
                                @click="clear()"
                                class="mb-4"
                                dark
                            >
                                Clear
                            </v-btn>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <template>
                                <v-data-table
                                    :headers="headers"
                                    :items="userData"
                                    :items-per-page="5"
                                    class="elevation-1"
                                ></v-data-table>
                            </template>
                        </v-col>
                    </v-row>
                </v-form>
            </v-container>

            <v-overlay :value="Overlay">
                <v-progress-circular
                    indeterminate
                    size="64"
                ></v-progress-circular>
            </v-overlay>
        </div>
    </v-app>
</template>
<script>
// import _ from "lodash";
export default {
    created() {
        this.get_all_user_data();
    },
    watch: {},
    data() {
        return {
            search: "",
            headers: [
                { text: "Name", value: "name" },
                { text: "E-mail", value: "email" },
                { text: "Mobile", value: "mobile" },
                { text: "Address", value: "address" },
                { text: "Status", value: "status" },
                { text: "Created At", value: "created_at" },
            ],
            userData: [],
            Overlay: false,
            UserData: {
                id: "new",
                name: "",
                email: "",
                address: "",
                mobile: "",
            },
        };
    },
    methods: {
        add_users() {
            if (this.$refs.form.validate()) {
                let result = false;
                if (this.UserData.id == "new") {
                    let mail = this.UserData.email;
                    let data = this.userData;
                    let getresult = _.filter(data, {
                        email: mail,
                    });

                    if (getresult.length > 0) {
                        result = false;
                        alert("Existing User!");
                    } else {
                        result = true;
                    }
                } else {
                    result = true;
                }

                if (result) {
                    this.Overlay = true;
                    let formData = new FormData();

                    formData.append("id", this.UserData.id);
                    formData.append("name", this.UserData.name);
                    formData.append("email", this.UserData.email);
                    formData.append("address", this.UserData.address);
                    formData.append("mobile", this.UserData.mobile);

                    axios.post("/api/add-users", formData).then((response) => {
                        this.snackColor = "success";
                        this.snackbar = true;
                        this.snackMessage = "User Succefully Added";
                        this.get_all_user_data();
                        this.clear();
                        this.Overlay = false;
                        console.log(response);
                    });
                }
            }
        },

        get_all_user_data() {
            axios
                .post("/api/all-user-data")
                .then((response) => {
                    this.userData = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        clear() {
            this.UserData.name = null;
            this.UserData.email = null;
            this.UserData.address = null;
            this.UserData.mobile = null;
        },
    },
};
</script>
