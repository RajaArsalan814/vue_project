export default [
  {
    title: 'Dashboards',
    icon: 'HomeIcon',
    tag: '2',
    tagVariant: 'light-warning',
    children: [
      {
        title: 'eCommerce',
        route: 'dashboard-ecommerce',
      },
      {
        title: 'Analytics',
        route: 'dashboard-analytics',
      },
    ],
  },
  {
    title: 'Finance',
    icon: 'FileTextIcon',  
    children: [
      {
        title: 'Transaction History',
        route: 'apps-invoice-list',
      },
      {
        title: 'Salary Management',
        route: 'apps-salary-management',
      },
      {
        title: 'Agent Invoicing',
        route: '',
      },
      {
        title: 'Sales Report',
        route: '',
      },
    ],
  },
  
  {
    title: 'Teacher Management',
    icon: 'UserIcon',  
    children: [
      {
        title: 'Teacher List',
        route: 'apps-users-list',
      },
      {
        title: 'Timetable Approval',
        route: '',
      },
      {
        title: 'Class Cancellation',
        route: '',
      },
      {
        title: 'Agent Invoicing',
        route: '',
      },

    ],
  },
  
  {
    title: 'Event Logs',
    route: 'event-logs',
    icon: 'MailIcon', 
  },
  {
    title: 'Chats',
    route: 'apps-chat',
    icon: 'MessageSquareIcon', 
  },
  
  {
    icon: 'AirplayIcon', 
    title: 'Classes',
    route: 'apps-classes',
  },
  {
    title: 'Helpdesk',
    route: 'apps-email',
    icon: 'FileTextIcon', 
  }, 
  {
    title: 'User Accounts',
    icon: 'UserIcon',  
    children: [
      {
        title: 'Students',
        route: 'apps-student-list',
      },
      {
        title: 'Parents',
        route: 'apps-parents-list',
      },
      {
        title: 'Agents',
        route: '',
      },
      {
        title: 'Administrator',
        route: '',
      }, 
    ],
  },
  
  {
    title: 'Module Management',
    icon: 'ArchiveIcon',  
    children: [
      {
        title: 'Module Creation',
        route: '',
        children: [
          {
            title: 'Global Levels',
            route: 'apps-gls-list',
          },
          {
            title: 'Modules',
            route: 'apps-module-list',
          },
          {
            title: 'Lessons',
            route: 'apps-lesson-list',
          }, 
        ],
      },
      {
        title: 'ePrep',
        route: 'apps-e-prep-list',
      },
      {
        title: 'eClassroom',
        route: 'apps-e-classroom-list',
      },
      {
        title: 'Lesson Plan',
        route: 'apps-lesson-plan-list',
      },
      {
        title: 'eRevision',
        route: 'apps-e-revision-list',
      },
      {
        title: 'Answer Key',
        route: 'apps-answer-key-list',
      },
      {
        title: 'Subject Controls',
        route: '',
      },
      {
        title: 'Announcement',
        route: 'apps-announcement-list',
      },
      {
        title: 'Public Holiday',
        route: 'apps-public-holiday-list',
      },
    ],
  },
  
]
