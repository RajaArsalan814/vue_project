export default [
  {
    path: '/apps/calendar',
    name: 'apps-calendar',
    component: () => import('@/views/apps/calendar/Calendar.vue'),
  },

  // *===============================================---*
  // *--------- EMAIL & IT'S FILTERS N LABELS -------------------------------*
  // *===============================================---*
  {
    path: '/apps/email',
    name: 'apps-email',
    component: () => import('@/views/apps/email/Email.vue'),
    meta: {
      contentRenderer: 'sidebar-left',
      contentClass: 'email-application',
    },
  },
  {
    path: '/apps/email/:folder',
    name: 'apps-email-folder',
    component: () => import('@/views/apps/email/Email.vue'),
    meta: {
      contentRenderer: 'sidebar-left',
      contentClass: 'email-application',
      navActiveLink: 'apps-email',
    },
    beforeEnter(to, _, next) {
      if (['sent', 'draft', 'starred', 'spam', 'trash'].includes(to.params.folder)) next()
      else next({ name: 'error-404' })
    },
  },
  {
    path: '/apps/email/label/:label',
    name: 'apps-email-label',
    component: () => import('@/views/apps/email/Email.vue'),
    meta: {
      contentRenderer: 'sidebar-left',
      contentClass: 'email-application',
      navActiveLink: 'apps-email',
    },
    beforeEnter(to, _, next) {
      if (['personal', 'company', 'important', 'private'].includes(to.params.label)) next()
      else next({ name: 'error-404' })
    },
  },

  // *===============================================---*
  // *--------- TODO & IT'S FILTERS N TAGS ---------------------------------------*
  // *===============================================---*
  {
    path: '/apps/todo',
    name: 'apps-todo',
    component: () => import('@/views/apps/todo/Todo.vue'),
    meta: {
      contentRenderer: 'sidebar-left',
      contentClass: 'todo-application',
    },
  },
  {
    path: '/apps/todo/:filter',
    name: 'apps-todo-filter',
    component: () => import('@/views/apps/todo/Todo.vue'),
    meta: {
      contentRenderer: 'sidebar-left',
      contentClass: 'todo-application',
      navActiveLink: 'apps-todo',
    },
    beforeEnter(to, _, next) {
      if (['important', 'completed', 'deleted'].includes(to.params.filter)) next()
      else next({ name: 'error-404' })
    },
  },
  {
    path: '/apps/todo/tag/:tag',
    name: 'apps-todo-tag',
    component: () => import('@/views/apps/todo/Todo.vue'),
    meta: {
      contentRenderer: 'sidebar-left',
      contentClass: 'todo-application',
      navActiveLink: 'apps-todo',
    },
    beforeEnter(to, _, next) {
      if (['team', 'low', 'medium', 'high', 'update'].includes(to.params.tag)) next()
      else next({ name: 'error-404' })
    },
  },

  // *===============================================---*
  // *--------- CHAT  ---------------------------------------*
  // *===============================================---*
  {
    path: '/apps/chat',
    name: 'apps-chat',
    component: () => import('@/views/apps/chat/Chat.vue'),
    meta: {
      contentRenderer: 'sidebar-left',
      contentClass: 'chat-application',
    },
  },

  // *===============================================---*
  // *--------- ECOMMERCE  ---------------------------------------*
  // *===============================================---*
  {
    path: '/apps/e-commerce/shop',
    name: 'apps-e-commerce-shop',
    component: () => import('@/views/apps/e-commerce/e-commerce-shop/ECommerceShop.vue'),
    meta: {
      contentRenderer: 'sidebar-left-detached',
      contentClass: 'ecommerce-application',
      pageTitle: 'Shop',
      breadcrumb: [
        {
          text: 'ECommerce',
        },
        {
          text: 'Shop',
          active: true,
        },
      ],
    },
  },
  {
    path: '/apps/e-commerce/wishlist',
    name: 'apps-e-commerce-wishlist',
    component: () => import('@/views/apps/e-commerce/e-commerce-wishlist/ECommerceWishlist.vue'),
    meta: {
      pageTitle: 'Wishlist',
      contentClass: 'ecommerce-application',
      breadcrumb: [
        {
          text: 'ECommerce',
        },
        {
          text: 'Wishlist',
          active: true,
        },
      ],
    },
  },
  {
    path: '/apps/e-commerce/checkout',
    name: 'apps-e-commerce-checkout',
    component: () => import('@/views/apps/e-commerce/e-commerce-checkout/ECommerceCheckout.vue'),
    meta: {
      pageTitle: 'Checkout',
      contentClass: 'ecommerce-application',
      breadcrumb: [
        {
          text: 'ECommerce',
        },
        {
          text: 'Checkout',
          active: true,
        },
      ],
    },
  },
  {
    path: '/apps/e-commerce/:slug',
    name: 'apps-e-commerce-product-details',
    component: () => import('@/views/apps/e-commerce/e-commerce-product-details/ECommerceProductDetails.vue'),
    meta: {
      pageTitle: 'Product Details',
      contentClass: 'ecommerce-application',
      breadcrumb: [
        {
          text: 'ECommerce',
        },
        {
          text: 'Shop',
          active: true,
        },
        {
          text: 'Product Details',
          active: true,
        },
      ],
    },
  },

  // *===============================================---*
  // *--------- USER ---- ---------------------------------------*
  // *===============================================---*
  {
    path: '/apps/users/list',
    name: 'apps-users-list',
    component: () => import('@/views/apps/user/users-list/UsersList.vue'),
  }, 
  {
    path: '/apps/parents/list',
    name: 'apps-parents-list',
    component: () => import('@/views/apps/parents/parents-list/UsersList.vue'),
  },  
  {
    path: '/apps/student/list',
    name: 'apps-student-list',
    component: () => import('@/views/apps/student/student-list/UsersList.vue'),
  },
  {
    path: '/apps/announcement/list',
    name: 'apps-announcement-list',
    component: () => import('@/views/apps/announcement/announcement-list/UsersList.vue'),
  },
  {
    path: '/apps/public-holiday/list',
    name: 'apps-public-holiday-list',
    component: () => import('@/views/apps/public-holiday/public-holiday-list/UsersList.vue'),
  },
  { 
    path: '/apps/classes/list',
    name: 'apps-classes',
    component: () => import('@/views/apps/classes/classes-list/ClassList.vue'),
  },
  {
    path: '/apps/event-logs',
    name: 'event-logs',
    component: () => import('@/views/apps/event-logs/event-logs-view/UsersEdit.vue'),
  },
  {
    path: '/apps/users/view/:id',
    name: 'apps-users-view',
    component: () => import('@/views/apps/user/users-view/UsersView.vue'),
  },
  {
    path: '/apps/users/edit/:id',
    name: 'apps-users-edit',
    component: () => import('@/views/apps/user/users-edit/UsersEdit.vue'),
  },

  {
    path: '/apps/gls/list',
    name: 'apps-gls-list',
    component: () => import('@/views/apps/gls/gls-list/List.vue'),
  },
  {
    path: '/apps/module/list',
    name: 'apps-module-list',
    component: () => import('@/views/apps/module/module-list/List.vue'),
  },
  {
    path: '/apps/lesson/list',
    name: 'apps-lesson-list',
    component: () => import('@/views/apps/lesson/lesson-list/List.vue'),
  },
  {
    path: '/apps/lesson-plan/list',
    name: 'apps-lesson-plan-list',
    component: () => import('@/views/apps/lesson-plan/lesson-plan-list/List.vue'),
  },
  {
    path: '/apps/e-revision/list',
    name: 'apps-e-revision-list',
    component: () => import('@/views/apps/e-revision/e-revision-list/List.vue'),
  },
  {
    path: '/apps/e-classroom/list',
    name: 'apps-e-classroom-list',
    component: () => import('@/views/apps/e-classroom/e-classroom-list/List.vue'),
  },
  
  {
    path: '/apps/classroom-activity/:id',
    name: 'classroom-activity',
    component: () => import('@/views/apps/classroom-activity/classroom-activity-list/List.vue'),
  },
  
  {
    path: '/apps/e-token/:id/:user',
    name: 'e-token',
    component: () => import('@/views/apps/e-token/e-token-list/List.vue'),
  },
  {
    path: '/apps/add-notes/:id/:user',
    name: 'add-notes',
    component: () => import('@/views/apps/add-notes/add-notes-list/List.vue'),
  },
  {
    path: '/apps/book-class/:id/:user',
    name: 'book-class',
    component: () => import('@/views/apps/book-class/book-class-list/List.vue'),
  },
  {
    path: '/apps/assign-module/:id/:user',
    name: 'assign-module',
    component: () => import('@/views/apps/assign-module/assign-module-list/List.vue'),
  },
  {
    path: '/apps/eprep-activity/:id',
    name: 'eprep-activity',
    component: () => import('@/views/apps/eprep-activity/eprep-activity-list/List.vue'),
  },
  { 
    path: '/apps/answer-key/list',
    name: 'apps-answer-key-list',
    component: () => import('@/views/apps/answer-key/answer-key-list/List.vue'),
  },
  {
    path: '/apps/e-prep/list',
    name: 'apps-e-prep-list',
    component: () => import('@/views/apps/e-prep/e-prep-list/List.vue'),
  },
  
  // Invoice 
  {
    path: '/apps/invoice/list',
    name: 'apps-invoice-list',
    component: () => import('@/views/apps/invoice/invoice-list/InvoiceList.vue'),
  },
  {
    path: '/apps/invoice/preview/:id',
    name: 'apps-invoice-preview',
    component: () => import('@/views/apps/invoice/invoice-preview/InvoicePreview.vue'),
  },
  {
    path: '/apps/invoice/add/',
    name: 'apps-invoice-add',
    component: () => import('@/views/apps/invoice/invoice-add/InvoiceAdd.vue'),
  },
  {
    path: '/apps/invoice/edit/:id',
    name: 'apps-invoice-edit',
    component: () => import('@/views/apps/invoice/invoice-edit/InvoiceEdit.vue'),
  },
]
