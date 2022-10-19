<template>
  <section id="dashboard-ecommerce">
    <b-row class="match-height">
      <b-col
        xl="4"
        md="6"
      >
        <ecommerce-medal :data="data.congratulations"  :total_stats="total_stats" />
      </b-col>
      <b-col
        xl="8"
        md="6"
      >
        <ecommerce-statistics :data="data.statisticsItems" :total_stats="total_stats" />
      </b-col>
    </b-row>

     <b-row class="match-height">
      <b-col lg="4">
        <b-row class="match-height">
          <b-col
            lg="6"
            md="3"
            cols="6"
          >
            <ecommerce-order-chart :data="data.statisticsOrder" :total_stats="total_stats" />
          </b-col>
          <b-col
            lg="6"
            md="3"
            cols="6"
          >
            <ecommerce-profit-chart :data="data.statisticsProfit" />
          </b-col>
          <b-col
            lg="12"
            md="6"
          >
            <ecommerce-earnings-chart :data="data.earningsChart" />
          </b-col>
        </b-row>
      </b-col>

      <b-col lg="8">
        <ecommerce-revenue-report :data="data.revenue" />
      </b-col>
    </b-row>

    <h2>Best Agents</h2>
    <b-row class="match-height">
      <b-col lg="12">
        <ecommerce-company-table :table-data="data.companyTable" :total_stats="total_stats" />
      </b-col>

    </b-row>
    <h2>Latest Confirmed Classes</h2>
    <b-row class="match-height">
      <b-col lg="8">
        <ecommerce-latest-table :table-data="data.companyTable" :total_stats="total_stats" />
      </b-col>
      <!-- Transaction Card -->
      <b-col
        lg="4"
      >
        <ecommerce-transactions :data="data.transactionData" :total_stats="total_stats" />
      </b-col>
    </b-row>

       <!-- <b-col
        lg="4"
        md="6"
      >
        <ecommerce-meetup :data="data.meetup" />
      </b-col>  -->
      <!--/ Developer Meetup Card -->

      <!-- Browser States Card -->
      <!-- <b-col
        lg="4"
        md="6"
      >
        <ecommerce-browser-states />
      </b-col> -->
      <!--/ Browser States Card -->

      <!-- Goal Overview Card -->
      <!-- <b-col
        lg="4"
        md="6"
      >
        <ecommerce-goal-overview :data="data.goalOverview" />
      </b-col> -->
      <!--/ Goal Overview Card -->

      <!--/ Transaction Card -->
    <!-- </b-row> -->
  </section>
</template>

<script>
import { BRow, BCol } from 'bootstrap-vue'

import { getUserData } from '@/auth/utils'
import EcommerceMedal from './EcommerceMedal.vue'
import EcommerceStatistics from './EcommerceStatistics.vue'
import EcommerceRevenueReport from './EcommerceRevenueReport.vue'
import EcommerceOrderChart from './EcommerceOrderChart.vue'
import EcommerceProfitChart from './EcommerceProfitChart.vue'
import EcommerceEarningsChart from './EcommerceEarningsChart.vue'
import EcommerceCompanyTable from './EcommerceCompanyTable.vue'
import EcommerceLatestTable from './EcommerceLatestTable.vue'
import EcommerceLatestPurchaseTable from './EcommerceLatestPurchaseTable.vue'
import EcommerceMeetup from './EcommerceMeetup.vue'
import EcommerceBrowserStates from './EcommerceBrowserStates.vue'
import EcommerceGoalOverview from './EcommerceGoalOverview.vue'
import EcommerceTransactions from './EcommerceTransactions.vue'
import StoreModule from './StoreModule'
import axios from 'axios';

export default {
  components: {
    BRow,
    BCol,

    EcommerceMedal,
    EcommerceStatistics,
    EcommerceRevenueReport,
    EcommerceOrderChart,
    EcommerceProfitChart,
    EcommerceEarningsChart,
    EcommerceCompanyTable,
    EcommerceLatestTable,
    EcommerceLatestPurchaseTable,
    EcommerceMeetup,
    EcommerceBrowserStates,
    EcommerceGoalOverview,
    EcommerceTransactions,
  },
  data() {

    return {
      data: {
    },
    total_stats :"",
    }
  },
  StoreModule,
  created() {

    axios.get(`/api/dashboard`)
    .then(response => {
        this.total_stats = response.data
    })
    .catch(e => {
      this.errors.push(e)
    }),

    this.$http.get('/ecommerce/data').then(response => {
    this.data = response.data

      // ? Your API will return name of logged in user or you might just directly get name of logged in user
      // ? This is just for demo purpose
      const userData = getUserData()
      this.data.congratulations.name = userData.username
    })
  },
  methods: {
        },
}
</script>

<style lang="scss">
@import '~@resources/scss/vue/pages/dashboard-ecommerce.scss';
@import '~@resources/scss/vue/libs/chart-apex.scss';
</style>
