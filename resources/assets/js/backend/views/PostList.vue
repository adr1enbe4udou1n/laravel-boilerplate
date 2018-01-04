<template>
  <div class="animated fadeIn">
    <b-card>
      <template slot="header">
        <div class="pull-right mt-2" v-if="this.$app.user.can('create posts')">
          <b-button to="/posts/create" variant="success" size="sm">
            <i class="icon-plus"></i> {{ $t('buttons.posts.create') }}
          </b-button>
        </div>
        <h4 class="mt-1">{{ $t('labels.backend.posts.titles.index') }}</h4>
      </template>
      <b-datatable ref="datasource"
                   @context-changed="onContextChanged"
                   search-route="admin.posts.search"
                   delete-route="admin.posts.destroy"
                   action-route="admin.posts.batch_action" :actions="actions"
                   @bulk-action-success="onBulkActionSuccess">
        <b-table ref="datatable"
                 striped
                 bordered
                 show-empty
                 stacked="md"
                 no-local-sorting
                 :empty-text="$t('labels.datatables.no_results')"
                 :empty-filtered-text="$t('labels.datatables.no_matched_results')"
                 :fields="fields"
                 :items="dataLoadProvider"
                 sort-by="created_at"
                 :sort-desc="true"
                 :busy.sync="isBusy"
        >
          <template slot="HEAD_checkbox" slot-scope="data"></template>
          <template slot="checkbox" slot-scope="row">
            <b-form-checkbox :value="row.item.id" v-model="selected"></b-form-checkbox>
          </template>
          <template slot="image" slot-scope="row">
            <router-link v-if="row.item.can_edit" :to="`/posts/${row.item.id}/edit`">
              <img :src="row.item.thumbnail_image_path" :alt="row.item.title">
            </router-link>
            <img v-else :src="row.item.thumbnail_image_path" :alt="row.item.title">
          </template>
          <template slot="title" slot-scope="row">
            <router-link v-if="row.item.can_edit" :to="`/posts/${row.item.id}/edit`" v-text="row.value"></router-link>
            <span v-else v-text="row.value"></span>
          </template>
          <template slot="status" slot-scope="row">
            <b-badge :variant="row.item.state">{{ $t(row.item.status_label) }}</b-badge>
          </template>
          <template slot="pinned" slot-scope="row">
            <c-switch v-if="row.item.can_edit" type="text" variant="primary" on="On" off="Off" :checked="row.value" @change="onPinToggle(row.item.id)"></c-switch>
          </template>
          <template slot="promoted" slot-scope="row">
            <c-switch v-if="row.item.can_edit" type="text" variant="primary" on="On" off="Off" :checked="row.value" @change="onPromoteToggle(row.item.id)"></c-switch>
          </template>
          <template slot="owner" slot-scope="row">
            {{ row.item.owner.name }}
          </template>
          <template slot="actions" slot-scope="row">
            <b-button size="sm" variant="success" :href="$app.route('blog.show', { post: row.item.slug})" target="_blank" v-b-tooltip.hover :title="$t('buttons.preview')" class="mr-1">
              <i class="icon-eye"></i>
            </b-button>
            <b-button v-if="row.item.can_edit" size="sm" variant="primary" :to="`/posts/${row.item.id}/edit`" v-b-tooltip.hover :title="$t('buttons.edit')" class="mr-1">
              <i class="icon-pencil"></i>
            </b-button>
            <b-button v-if="row.item.can_delete" size="sm" variant="danger" v-b-tooltip.hover :title="$t('buttons.delete')" @click.stop="onDelete(row.item.id)">
              <i class="icon-trash"></i>
            </b-button>
          </template>
        </b-table>
      </b-datatable>
    </b-card>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'post_list',
    data () {
      return {
        isBusy: false,
        selected: [],
        fields: [
          { key: 'checkbox' },
          { key: 'image', label: this.$t('validation.attributes.image'), sortable: true },
          { key: 'title', label: this.$t('validation.attributes.title') },
          { key: 'status', label: this.$t('validation.attributes.status'), 'class': 'text-center' },
          { key: 'pinned', label: this.$t('validation.attributes.pinned'), 'class': 'text-center' },
          { key: 'promoted', label: this.$t('validation.attributes.promoted'), 'class': 'text-center' },
          { key: 'owner', label: this.$t('labels.author') },
          { key: 'created_at', label: this.$t('labels.created_at'), 'class': 'text-center', sortable: true },
          { key: 'updated_at', label: this.$t('labels.updated_at'), 'class': 'text-center', sortable: true },
          { key: 'actions', label: this.$t('labels.actions'), 'class': 'nowrap' }
        ],
        actions: {
          destroy: this.$t('labels.backend.posts.actions.destroy'),
          publish: this.$t('labels.backend.posts.actions.publish'),
          pin: this.$t('labels.backend.posts.actions.pin'),
          promote: this.$t('labels.backend.posts.actions.promote')
        }
      }
    },
    methods: {
      dataLoadProvider (ctx) {
        return this.$refs.datasource.loadData(ctx.sortBy, ctx.sortDesc)
      },
      onContextChanged () {
        return this.$refs.datatable.refresh()
      },
      onDelete (id) {
        this.$refs.datasource.deleteRow({ post: id })
      },
      onBulkActionSuccess () {
        this.selected = []
      },
      onPinToggle (id) {
        axios.post(this.$app.route('admin.posts.pinned', {post: id}))
          .catch((error) => {
            this.$app.error(error)
          })
      },
      onPromoteToggle (id) {
        axios.post(this.$app.route('admin.posts.promoted', {post: id}))
          .catch((error) => {
            this.$app.error(error)
          })
      }
    },
    watch: {
      selected (value) {
        this.$refs.datasource.selected = value
      }
    }
  }
</script>
