<template>
    <b-container>
        <b-row>
            <b-col>
                <h1>Cheats</h1>
            </b-col>
            <div>
                <b-btn variant="primary" v-b-modal.cheat_form>
                    Add Cheat
                </b-btn>
            </div>
            <div>
                <cheat-show
                    v-for="cheat in cheats"
                    :key="cheat.uuid"
                    :cheat=cheat />
            </div>
        </b-row>

        <b-modal
            id="cheat_form"
            :title="form_title"
            ok-title="Save"
            @ok="submitForm"
            @shown="clearForm">
            <b-form @submit.stop.prevent="saveCheat">
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
            return this.edit_cheat.uuid.length > 0 ? 'Save Cheat' : 'Add New Cheat';
        }
    },
    data() {
        return {
            cheats: [],
            edit_cheat: {
                'name': '',
                'code': '',
                'description': '',
                'uuid': ''
            }
        }
    },
    methods: {
        clearForm() {
            this.edit_cheat.name = '',
            this.edit_cheat.code = '',
            this.edit_cheat.description = ''
        },
        saveCheat() {
            this.saveCheat();
            this.clearForm();
            this.$refs.modal.hide();
        },
        submitForm(e) {
            e.preventDefault();
            if (this.edit_cheat.uuid.length > 0) {
                axios.put(
                    `/api/cheats/${this.edit_cheat.uuid}`,
                    {cheat: this.edit_cheat}
                );
            } else {
                axios.post('/api/cheats', {cheat: this.edit_cheat});
            }
        }
    },
    mounted() {
        axios.get('/api/cheats')
        .then(({ data }) => {
            this.cheats = data;
        });
    }
}
</script>
