<template>
  <div>
    <b-row class="justify-content-center">
      <b-col xl="6">
        <b-card>
          <h3 class="card-title" slot="header">
            {{ $t('labels.backend.form_submissions.titles.show') }}
          </h3>
          <table
            class="table table-striped table-hover"
            v-if="submission !== null"
          >
            <tbody>
              <tr
                v-for="(value, name) in JSON.parse(submission.data)"
                :key="name"
              >
                <th>{{ $t(`validation.attributes.${name}`) }}</th>
                <td>{{ value }}</td>
              </tr>
              <tr>
                <th>{{ $t('labels.created_at') }}</th>
                <td>{{ submission.created_at }}</td>
              </tr>
            </tbody>
          </table>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'FormSubmissionForm',
  props: {
    id: {
      type: String,
      default: null
    }
  },
  data() {
    return {
      submission: null
    }
  },
  async created() {
    let { data } = await axios.get(
      this.$app.route('admin.form_submissions.show', {
        form_submission: this.id
      })
    )
    this.submission = data
  }
}
</script>
