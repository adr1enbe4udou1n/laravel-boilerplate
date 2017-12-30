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
      <b-datatable ref="datatable"
                   :sort-by="sortBy"
                   :sort-desc="sortDesc"
                   @data-loaded="onDataLoaded"
                   search-route="admin.posts.search"
                   delete-route="admin.posts.destroy"
                   action-route="admin.posts.batch_action" :actions="actions">
        <b-table striped
                 bordered
                 show-empty
                 stacked="md"
                 no-local-sorting
                 :empty-text="$t('labels.datatables.no_results')"
                 :empty-filtered-text="$t('labels.datatables.no_matched_results')"
                 :fields="fields"
                 :items="items"
                 :sort-by="sortBy"
                 :sort-desc="sortDesc"
                 @sort-changed="onSort"
        >
          <template slot="image" slot-scope="row">
            <router-link :to="`/posts/${row.item.id}/edit`">
              <img :src="row.item.thumbnail_image_path" :alt="row.item.title">
              {{row.value}}
            </router-link>
          </template>
          <template slot="title" slot-scope="row">
            <router-link :to="`/posts/${row.item.id}/edit`">
              {{row.value}}
            </router-link>
          </template>
          <template slot="status" slot-scope="row">
            <b-badge :variant="row.item.state">{{ $t(row.item.status_label) }}</b-badge>
          </template>
          <template slot="pinned" slot-scope="row">
            <b-badge :variant="row.value ? 'success' : 'danger'">{{ row.value ? $t('labels.yes') : $t('labels.no') }}</b-badge>
          </template>
          <template slot="promoted" slot-scope="row">
            <b-badge :variant="row.value ? 'success' : 'danger'">{{ row.value ? $t('labels.yes') : $t('labels.no') }}</b-badge>
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
  export default {
    name: 'post_list',
    data () {
      return {
        items: [],
        fields: [
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
        sortBy: 'created_at',
        sortDesc: true,
        actions: {
          destroy: this.$t('labels.backend.posts.actions.destroy'),
          publish: this.$t('labels.backend.posts.actions.publish'),
          pin: this.$t('labels.backend.posts.actions.pin'),
          promote: this.$t('labels.backend.posts.actions.promote')
        }
      }
    },
    methods: {
      onDataLoaded (items) {
        this.items = items
      },
      onSort (ctx) {
        this.$refs.datatable.sort(ctx.sortBy, ctx.sortDesc)
      },
      onDelete (id) {
        this.$refs.datatable.deleteRow(id)
      }
    }
  }
</script>
