<template>

  <div>

    <list-add-new :is-add-new-user-sidebar-active.sync="isAddNewUserSidebarActive" :edit-data.sync="editData"
      :role-options="roleOptions" :plan-options="planOptions" :email-view-data="emailViewData"
      @refetch-data="refetchData" />

    <!-- Filters -->
    <!--   <users-list-filters
      :role-filter.sync="roleFilter"
      :plan-filter.sync="planFilter"
      :status-filter.sync="statusFilter"
      :role-options="roleOptions"
      :plan-options="planOptions"
      :status-options="statusOptions"
    /> -->

    <!-- Table Container Card -->
    <b-card no-body class="mb-0">

      <div class="m-2">

        <!-- Table Top -->
        <b-row>

          <!-- Per Page -->
          <b-col cols="12" md="6" class="d-flex align-items-center justify-content-start mb-1 mb-md-0">
            <label>Show</label>
            <v-select v-model="perPage" :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'" :options="perPageOptions"
              :clearable="false" class="per-page-selector d-inline-block mx-50" />
            <label>entries</label>
          </b-col>

          <!-- Search -->
          <b-col cols="12" md="6">
            <div class="d-flex align-items-center justify-content-end">
              <b-form-input v-model="searchQuery" class="d-inline-block mr-1" placeholder="Search..." />
              <b-button variant="primary" @click="isAddNewUserSidebarActive = true">
                <span class="text-nowrap">Add Answer Key</span>
              </b-button>
            </div>
          </b-col>
        </b-row>

      </div>
      <b-table ref="refUserListTable" class="position-relative" :items="fetchUsers" responsive :fields="tableColumns"
        primary-key="id" :sort-by.sync="sortBy" show-empty empty-text="No matching records found"
        :sort-desc.sync="isSortDirDesc">

        <!-- Column: Status -->
        <template #cell(visibility)="data">
          <b-badge pill v-if="data.item.visibility == 1" variant="danger" class="text-capitalize"> No
          </b-badge>
          <b-badge pill v-if="data.item.visibility == 0" variant="success" class="text-capitalize"> YES
          </b-badge>
        </template>

        <template #cell(id)="data">
          {{ data.index + 1 }}
        </template>

        <!-- Column: Actions -->
        <template #cell(actions)="data">
          <b-dropdown variant="link" no-caret :right="$store.state.appConfig.isRTL">

            <template #button-content>
              <feather-icon icon="MoreVerticalIcon" size="16" class="align-middle text-body" />
            </template>
            <b-dropdown-item @click="handleTaskClick(data.item); ">
              <feather-icon icon="EditIcon" />
              <span class="align-middle ml-50">Edit</span>
            </b-dropdown-item>

            <b-dropdown-item @click="deleteUsers(data.item.id)">
              <feather-icon icon="TrashIcon" />
              <span class="align-middle ml-50">Delete</span>
            </b-dropdown-item>
          </b-dropdown>
        </template>

      </b-table>
      <div class="mx-2 mb-2">
        <b-row>

          <b-col cols="12" sm="6" class="d-flex align-items-center justify-content-center justify-content-sm-start">
            <span class="text-muted">Showing {{ dataMeta.from }} to {{ dataMeta.to }} of {{ dataMeta.of }}
              entries</span>
          </b-col>
          <!-- Pagination -->
          <b-col cols="12" sm="6" class="d-flex align-items-center justify-content-center justify-content-sm-end">

            <b-pagination v-model="currentPage" :total-rows="totalUsers" :per-page="perPage" first-number last-number
              class="mb-0 mt-1 mt-sm-0" prev-class="prev-item" next-class="next-item">
              <template #prev-text>
                <feather-icon icon="ChevronLeftIcon" size="18" />
              </template>
              <template #next-text>
                <feather-icon icon="ChevronRightIcon" size="18" />
              </template>
            </b-pagination>

          </b-col>

        </b-row>
      </div>
    </b-card>
  </div>
</template>

<script>
import {
  BCard,
  BRow,
  BCol,
  BFormInput,
  BButton,
  BTable,
  BMedia,
  BAvatar,
  BLink,
  BBadge,
  BDropdown,
  BDropdownItem,
  BPagination,
} from 'bootstrap-vue'
import vSelect from 'vue-select'
import store from '@/store'
import { ref, onUnmounted } from '@vue/composition-api'
import { avatarText } from '@core/utils/filter'
import ListFilters from './ListFilters.vue'
import useList from './useList'
import StoreModule from '../StoreModule'
import ListAddNew from './ListAddNew.vue'

export default {
  components: {
    ListFilters,
    ListAddNew,
    BCard,
    BRow,
    BCol,
    BFormInput,
    BButton,
    BTable,
    BMedia,
    BAvatar,
    BLink,
    BBadge,
    BDropdown,
    BDropdownItem,
    BPagination,

    vSelect,
  },
  setup() {
    const USER_APP_STORE_MODULE_NAME = 'app-user'

    // Register module
    if (!store.hasModule(USER_APP_STORE_MODULE_NAME)) store.registerModule(USER_APP_STORE_MODULE_NAME, StoreModule)

    // UnRegister on leave
    onUnmounted(() => {
      if (store.hasModule(USER_APP_STORE_MODULE_NAME)) store.unregisterModule(USER_APP_STORE_MODULE_NAME)
    })
    /*   const delete_annannouncement = (id) => {
          store.dispatch('app-user/deleteUsers', id)
            .then(() => {   })
            .finally(() => {   })
        } */
    const isAddNewUserSidebarActive = ref(false)
    const editData = ref({})

    const emailViewData = ref({ 'name': 'aa' })
    const roleOptions = [
      { label: 'Comprehension - Comp', value: 'comp' },
      { label: 'E-Reading Scholars - ERS', value: 'ers' },
      { label: 'E-Creative Life Application - ECLA', value: 'ecla' },  
      { label: 'Eloquent Speaker - ES', value: 'es' },  
      { label: 'School of Grammar - SOG', value: 'sog' },  
      { label: 'Write Right Composer - WRC', value: 'wrc' },  
      { label: 'Intelligent Vocbulary Builder - IVB', value: 'ivb' },  
      { label: 'Phonics Bridging - PHONICS', value: 'phonics' }
    ]


    const announcementType = [
      { label: 'Announcement', value: 'announcement' },
      { label: 'Join', value: 'join' },
      { label: 'Schedule', value: 'schedule' },
    ]

    const planOptions = [
      { label: 'Basic', value: 'basic' },
      { label: 'Company', value: 'company' },
      { label: 'Enterprise', value: 'enterprise' },
      { label: 'Team', value: 'team' },
    ]

    const statusOptions = [
      { label: 'Pending', value: 'pending' },
      { label: 'Active', value: 'active' },
      { label: 'Inactive', value: 'inactive' },
    ]
    const task = ref(JSON.stringify(fetchUsers))
    const handleTaskClick = taskData => {
      // editData.value = true; 
      editData.value = taskData;
      isAddNewUserSidebarActive.value = true;
    }
    const {
      fetchUsers,
      tableColumns,
      perPage,
      currentPage,
      totalUsers,
      dataMeta,
      perPageOptions,
      searchQuery,
      sortBy,
      isSortDirDesc,
      refUserListTable,
      refetchData,
      editUsers,
      deleteUsers,
      // UI
      resolveUserRoleVariant,
      resolveUserRoleIcon,
      resolveUserStatusVariant,
      resolveUserStatusVariantData,
      // Extra Filters
      roleFilter,
      planFilter,
      statusFilter,
    } = useList()

    return {
      // Sidebar
      task,
      handleTaskClick,
      emailViewData,
      isAddNewUserSidebarActive,
      editData,
      fetchUsers,
      deleteUsers,
      tableColumns,
      perPage,
      currentPage,
      totalUsers,
      editUsers() {
        this.isAddNewUserSidebarActive = true;
      },
      dataMeta,
      perPageOptions,
      searchQuery,
      sortBy,
      isSortDirDesc,
      refUserListTable,
      refetchData,

      // Filter
      avatarText,

      // UI
      resolveUserRoleVariant,
      resolveUserRoleIcon,
      resolveUserStatusVariant,
      resolveUserStatusVariantData,

      roleOptions,
      planOptions,
      statusOptions,

      // Extra Filters
      roleFilter,
      planFilter,
      statusFilter,
    }
  },
}
</script>

<style lang="scss" scoped>
.per-page-selector {
  width: 90px;
}
</style>

<style lang="scss">
@import '~@resources/scss/vue/libs/vue-select.scss';
</style>
