
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  },

  {
    path: '/admin',
    component: () => import('layouts/admin/AdminLayout.vue'),
    children: [
      { path: 'login', component: () => import('pages/admin/authentication/Login.vue') },
      { path: 'departments', component: () => import('pages/admin/departments/Index.vue') },
      { path: 'doctors', component: () => import('pages/admin/doctors/Index.vue') },
      { path: 'financial-categories', component: () => import('pages/admin/financial-categories/Index.vue') },
      { path: 'main-services', component: () => import('pages/admin/main-services/Index.vue') },
      { path: 'medical-services', component: () => import('pages/admin/medical-services/Index.vue') },
      { path: 'pcs', component: () => import('pages/admin/pcs/Index.vue') },
      { path: 'reports', component: () => import('pages/admin/reports/Index.vue') },
      { path: 'stakeholders', component: () => import('pages/admin/stakeholders/Index.vue') },
      { path: 'systemworkers', component: () => import('pages/admin/systemworkers/Index.vue') },
      { path: 'transactions', component: () => import('pages/admin/transactions/Index.vue') },
      { path: 'billing-option', component: () => import('pages/admin/billing-option/Index.vue') },
      { path: 'closed-interval', component: () => import('pages/admin/closed-interval/Index.vue') },
      { path: 'ranks', component: () => import('pages/admin/ranks/Index.vue') },
      { path: 'price-types', component: () => import('pages/admin/priceTypes/Index.vue') },
      { path: 'service-types', component: () => import('pages/admin/serviceTypes/Index.vue') },
      { path: 'roles', component: () => import('pages/admin/roles/Index.vue') },
      { path: 'degrees', component: () => import('pages/admin/degrees/Index.vue') },
      { path: 'execute-reports', component: () => import('pages/admin/reports/Execute.vue') }
    ]
  },

  {
    path: '/',
    component: () => import('layouts/frontend/MainLayout.vue'),
    children: [
      { path: 'login', component: () => import('pages/frontend/authentication/Login.vue') },
      { path: 'home', component: () => import('pages/frontend/home/Home.vue') },
      { path: 'edit-profile', component: () => import('pages/frontend/profile/Editprofile.vue') },
      { path: 'not-found', component: () => import('pages/frontend/errors/Notfound.vue') },
      { path: 'not-have-permission', component: () => import('pages/frontend/errors/Permission.vue') },
      { path: 'service', component: () => import('pages/frontend/services/Service.vue') }
    ]
  },

  {
    path: '/report-results',
    component: () => import('layouts/PrintLayout.vue'),
    children: [
      { path: '', name: 'report-results', component: () => import('pages/admin/reports/Results.vue'), props: true }
    ]
  },

  {
    path: '/admin-panel',
    component: () => import('layouts/admin/AdminLayout.vue')
  }

]

export default routes
