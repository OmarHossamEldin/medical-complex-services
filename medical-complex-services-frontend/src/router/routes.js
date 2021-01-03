
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
      { path: 'systemworkers', component: () => import('pages/admin/systemworkers/Index.vue') },
      { path: 'transactions', component: () => import('pages/admin/transactions/Index.vue') }
    ]
  },

  {
    path: '/admin-panel',
    component: () => import('layouts/admin/AdminLayout.vue')
  }

]

export default routes
