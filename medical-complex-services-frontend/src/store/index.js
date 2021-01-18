import Vue from 'vue'
import Vuex from 'vuex'
import alerts from './modules/alerts'
import departments from './modules/departments'
import pcs from './modules/pcs'
import financialCategories from './modules/financial-categories'
import doctors from './modules/doctors'
import billingOptions from './modules/billing-options'
import transactions from './modules/transactions'
import modules from './modules/modules'
import services from './modules/services'
import closedIntervals from './modules/closed-intervals'
import systemWorkers from './modules/system-workers'

Vue.use(Vuex)

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */

export default function (/* { ssrContext } */) {
  const Store = new Vuex.Store({
    modules: {
      alerts,
      departments,
      pcs,
      financialCategories,
      doctors,
      billingOptions,
      transactions,
      modules,
      services,
      closedIntervals,
      systemWorkers
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEBUGGING
  })

  return Store
}
