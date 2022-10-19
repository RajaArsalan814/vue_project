import { ref, watch, computed } from '@vue/composition-api'
import store from '@/store'
import { title } from '@core/utils/filter'

// Notification
import { useToast } from 'vue-toastification/composition'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default function useUsersList() {
  // Use toast
  const toast = useToast()

  const refUserListTable = ref(null)

  // Table Handlers
  const tableColumns = [
    { key: 'no', sortable: true },
    { key: 'class_id', sortable: true }, 
    { key: 'type', label: 'Type', sortable: true },
    { key: 'username', sortable: true },
    { key: 'students_amount', label: 'Students', sortable: true },
    { key: 'class_date', sortable: true },
    { key: 'class_time', label: 'Pending Timeslot', sortable: true },
    { key: 'active_time_slot', label: 'Active Timeslot', sortable: true },
    { key: 'status', sortable: true },
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

  watch([currentPage, perPage, searchQuery, roleFilter, planFilter, statusFilter], () => {
    refetchData()
  })

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
        console.log(response.data)
        var page = {
          "status": "success",
          "pages": {
            "current_page": 1,
            "data": [
              {
                "no": 1,
                "class_id": "56xtsa1",
                "module": "module 1",
                "teacher_name": "elt teacher",
                "students_amount": "1",
                "class_date": "4 days ago",
                "class_time": "10:45",
                "status": 1,
              }, 
              {
                "no": 2,
                "class_id": "15rxdh7",
                "module": "module 7",
                "teacher_name": "elt teacher",
                "students_amount": "4",
                "class_date": "2 days ago",
                "class_time": "10:45",
                "status": 1,
              }, 
              {
                "no": 3,
                "class_id": "asty45s",
                "module": "module 7",
                "teacher_name": "jhon",
                "students_amount": "4",
                "class_date": "4 days ago",
                "class_time": "11:45",
                "status": 1,
              }, 
              {
                "no": 4,
                "class_id": "56jur12",
                "module": "module 7",
                "teacher_name": "reva",
                "students_amount": "2",
                "class_date": "2 days ago",
                "class_time": "12:45",
                "status": 1,
              }, 
              {
                "no": 5,
                "class_id": "454iaue",
                "module": "module 7",
                "teacher_name": "nik",
                "students_amount": "3",
                "class_date": "1 days ago",
                "class_time": "01:45",
                "status": 1,
              }, 
              {
                "no": 6,
                "class_id": "poi765q",
                "module": "module 7",
                "teacher_name": "reva",
                "students_amount": "4",
                "class_date": "4 days ago",
                "class_time": "02:45",
                "status": 1,
              }, 
            ],
            "first_page_url": "http://phpstack-764354-2704405.cloudwaysapps.com/admin/public/api/teacher/show?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://phpstack-764354-2704405.cloudwaysapps.com/admin/public/api/teacher/show?page=1",
            "links": [
              {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
              },
              {
                "url": "http://phpstack-764354-2704405.cloudwaysapps.com/admin/public/api/teacher/show?page=1",
                "label": "1",
                "active": true
              },
              {
                "url": null,
                "label": "Next &raquo;",
                "active": false
              }
            ],
            "next_page_url": null,
            "path": "http://phpstack-764354-2704405.cloudwaysapps.com/admin/public/api/teacher/show",
            "per_page": 10,
            "prev_page_url": null,
            "to": 2,
            "total": 2
          }
        }
      /*   const { data, total } = page.pages
        console.log(page.pages) */
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

  const deleteUsers = (id) => {
    store.dispatch('app-user/deleteUsers', id)
      .then(() => {    
        toast({
        component: ToastificationContent,
        props: {
          title: 'Lesson Plan Deleted Successfully',
          icon: 'CheckCircleIcon',
          variant: 'success',
        },
      }); refetchData();
     })
      .finally(() => {   })
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
    deleteUsers,
    refetchData,

    // Extra Filters
    roleFilter,
    planFilter,
    statusFilter,
  }
}
