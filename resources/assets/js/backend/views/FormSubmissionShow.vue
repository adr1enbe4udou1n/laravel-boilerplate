<template>
    <div class="animated fadeIn">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $t('labels.backend.form_submissions.titles.show') }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" v-if="submission !== null">
                            <tr v-for="(value, name) in JSON.parse(submission.data)">

                                <th>{{ $t(`validation.attributes.${name}`) }}</th>
                                <td>{{ value }}</td>
                            </tr>
                            <tr>
                                <th>{{ $t('labels.created_at') }}</th>
                                <td>{{ submission.created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'form_submission_form',
        props: ['id'],
        data() {
            return {
                submission: null
            };
        },
        created() {
            axios
                .get(`${this.$root.adminPath}/form-submission/${this.id}`)
                .then(response => {
                    this.submission = response.data;
                });
        }
    };
</script>
