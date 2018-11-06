<template>
    <b-container>
        <b-row>
            <b-col>
                <h1>Cheats</h1>
            </b-col>
            <b-col>
                <div class="float-right">
                    <div v-if="is_auth">
                        <b-btn variant="primary" v-b-modal.cheat_form>
                            Add Cheat
                        </b-btn>
                    </div>
                    <div v-else>
                        <b-btn variant="primary" href="/login">
                            Login
                        </b-btn>
                        <b-btn variant="primary" href="/register">
                            Register
                        </b-btn>
                    </div>
                </div>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <div>
                    <cheats-show
                        v-for="cheat in cheats"
                        v-on:edit="editCheat"
                        :key="cheat.uuid"
                        :cheat=cheat />
                </div>
            </b-col>
        </b-row>

        <b-modal
            id="cheat_form"
            @hide="hideForm"
            ok-title="Save"
            @ok="submitForm"
            ref="cheatModal"
            @shown="clearForm"
            :title="form_title">
            <b-form>
                <b-form-group
                    label="Name"
                    label-for="cheat_name"
                    description="A name for this cheat code">
                    <b-form-input id="cheat_name"
                        type="text"
                        v-model="edit_cheat.name"
                        required
                        placeholder="A descriptive name">
                    </b-form-input>
                </b-form-group>
                <b-form-group
                    label="Code"
                    label-for="cheat_code"
                    description="The actual cheat code">
                    <b-form-input id="cheat_code"
                        type="text"
                        v-model="edit_cheat.code"
                        required
                        placeholder="The cheat code">
                    </b-form-input>
                </b-form-group>
                <b-form-group
                    label="Description"
                    label-for="cheat_description"
                    description="A detailed description of the use of the cheat code.">
                    <b-form-textarea id="cheat_description"
                        v-model="edit_cheat.description"
                        placeholder="Describe the code in detail..."
                        :rows="3"
                        :max-rows="6">
                    </b-form-textarea>
                </b-form-group>
            </b-form>
        </b-modal>
    </b-container>
</template>

<script>
export default {
    computed: {
        form_title() {
            return this.edit_cheat.uuid == null ? 'Save Cheat' : 'Add New Cheat';
        },
        is_auth() {
            return window.is_auth;
        }
    },
    data() {
        return {
            cheats: [],
            edit_cheat: {
                'name': null,
                'code': null,
                'description': null,
                'uuid': null
            },
            is_editing: false
        }
    },
    methods: {
        clearForm() {
            if (!this.is_editing) {
                this.edit_cheat.name = null;
                this.edit_cheat.code = null;
                this.edit_cheat.description = null;
                this.edit_cheat.uuid = null;
            }
        },
        editCheat(cheat) {
            this.is_editing = true;
            this.edit_cheat.name = cheat.name;
            this.edit_cheat.code = cheat.code;
            this.edit_cheat.description = cheat.description;
            this.edit_cheat.uuid = cheat.uuid;
            this.$refs.cheatModal.show();
        },
        hideForm() {
            this.is_editing = false;
        },
        submitForm(e) {
            e.preventDefault();
            var method = 'POST';
            var url = '/api/cheats';
            if (this.edit_cheat.uuid != null) {
                method = 'PUT';
                url = `/api/cheats/${this.edit_cheat.uuid}`;
            }
            axios({
                method,
                url,
                data: {
                    name: this.edit_cheat.name,
                    code: this.edit_cheat.code,
                    description: this.edit_cheat.description,
                    uuid: this.edit_cheat.uuid
                }
            }).then(() => {
                this.$refs.cheatModal.hide();
                this.refreshCheats();
            });
        },
        refreshCheats() {
            axios({ method: 'GET', url: '/api/cheats' })
            .then(({ data }) => {
                this.cheats = data;
            });
        }
    },
    mounted() {
        this.refreshCheats();
    }
}
</script>
