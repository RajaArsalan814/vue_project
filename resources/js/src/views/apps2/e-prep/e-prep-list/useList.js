import { ref, watch, computed } from '@vue/composition-api'
import store from '@/store'
import { title } from '@core/utils/filter'

// Notification
import { useToast } from 'vue-toastification/composition'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default function useList() {
  // Use toast
  const toast = useToast()

  const refUserListTable = ref(null)

  // Table Handlers
  const tableColumns = [
    { key: 'id', label: 'No', sortable: true },  
    { key: 'title', label: 'Name',  sortable: true },  
    { key: 'level', label: 'Level',  sortable: true },  
    { key: 'module', label: 'Module',  sortable: true },  
    { key: 'lesson', label: 'Lesson',  sortable: true },  
    { key: 'visibility', label: 'Visibility',  sortable: true },   
    { key: 'components',label: 'Component',  sortable: true },  
    { key: 'updated_at',  sortable: true },  
    { key: 'actions' },
  ]
  const perPage = ref(10)
  const totalUsers = ref(0)
  const currentPage = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const roleFilter = ref(null)
  const planFilter = ref(null)
  const statusFilter = ref(null)

  const dataMeta = computed(() => {
    const localItemsCount = refUserListTable.value ? refUserListTable.value.localItems.length : 0
    return {
      from: perPage.value * (currentPage.value - 1) + (localItemsCount ? 1 : 0),
      to: perPage.value * (currentPage.value - 1) + localItemsCount,
      of: totalUsers.value,
    }
  })

  const refetchData = () => {
    refUserListTable.value.refresh()
  }
  const userData = ref({"name":"aa","id":"1"})
  watch([currentPage, perPage, searchQuery, roleFilter, planFilter, statusFilter], () => {
    refetchData()
  })
  const deleteUsers = (id) => {
    store.dispatch('app-user/deleteUsers', id)
      .then(() => {    
        toast({
        component: ToastificationContent,
        props: {
          title: 'ePrep Deleted Successfully',
          icon: 'CheckCircleIcon',
          variant: 'success',
        },
      }); refetchData();
     })
      .finally(() => {   })
  } 
  const fetchUsers = (ctx, callback) => {
    store
      .dispatch('app-user/fetchUsers', {
        q: searchQuery.value,
        perPage: perPage.value,
        page: currentPage.value,
        sortBy: sortBy.value,
        sortDesc: isSortDirDesc.value,
        role: roleFilter.value,
        plan: planFilter.value,
        status: statusFilter.value,
      })
      .then(response => { 
        const { data, total } = response.data.pages 
        callback(data)
        totalUsers.value = total
      })
      .catch(() => {
        toast({
          component: ToastificationContent,
          props: {
            title: 'Error fetching users list',
            icon: 'AlertTriangleIcon',
            variant: 'danger',
          },
        })
      })
  }

  // *===============================================---*
  // *--------- UI ---------------------------------------*
  // *===============================================---*

  const resolveUserRoleVariant = role => {
    if (role === 'subscriber') return 'primary'
    if (role === 'author') return 'warning'
    if (role === 'maintainer') return 'success'
    if (role === 'editor') return 'info'
    if (role === 'admin') return 'danger'
    return 'primary'
  }

  const resolveUserRoleIcon = role => {
    if (role === 'subscriber') return 'UserIcon'
    if (role === 'author') return 'SettingsIcon'
    if (role === 'maintainer') return 'DatabaseIcon'
    if (role === 'editor') return 'Edit2Icon'
    if (role === 'admin') return 'ServerIcon'
    return 'UserIcon'
  }

  const resolveUserStatusVariant = status => {
    if (status === 0) return 'warning'
    if (status === 1) return 'success'
    if (status === 2) return 'secondary'
    return 'primary'
  }

  const resolveUserStatusVariantData = status => {
    if (status === 0) return 'Padding'
    if (status === 1) return 'Active'
    if (status === 2) return 'DeActive'
    return 'primary'
  }

  return {
    fetchUsers,
    deleteUsers,
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

    resolveUserRoleVariant,
    resolveUserRoleIcon,
    resolveUserStatusVariant,
    resolveUserStatusVariantData,
    refetchData,
    userData,
    // Extra Filters
    roleFilter,
    planFilter,
    statusFilter,
  }
}
