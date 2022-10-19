<template>

  <b-card
    v-if="total_stats"
    no-body
    class="card-company-table"
  >

    <b-table
      :items="total_stats.agents_data"
      responsive
      :fields="fields"
      class="mb-0"
    >
      <!-- company -->
      <template #cell(company)="data">
        <div class="d-flex align-items-center">
          <!-- <b-avatar
            rounded
            size="32"
            variant="light-company"
          >
            <b-img
              :src="data.item.avatarImg"
              alt="avatar img"
            /></b-avatar> -->
          <div>
            <div class="font-weight-bolder">
              {{ data.item.id }}
            </div>
            <!-- <div class="font-small-2 text-muted">
              {{ data.item.id }}
            </div> -->
          </div>
        </div>
      </template>

      <!-- category -->
      <template #cell(category)="data">
        <div class="d-flex align-items-center">
          <!-- <b-avatar
            class="mr-1"
            :variant="data.item.user.username"
          >
            <feather-icon
              size="18"
              :icon="data.item.avatarIcon"
            />
          </b-avatar> -->
          <span>{{ data.item.agents.agent_user_name.username }}</span>
        </div>
      </template>

      <!-- views -->
      <template #cell(views)="data">
        <div class="d-flex flex-column">
          <!-- <span class="font-weight-bolder mb-25">{{ data.item.viewTitle }}</span> -->
          <span >{{ data.item.user.username }}</span>
        </div>
      </template>

      <!-- revenue -->
      <template #cell(revenue)="data">
        <span >{{ data.item.token.token_amount }}</span>
      </template>

      <!-- sales -->
      <!-- <template #cell(sales)="data">
        <div class="d-flex align-items-center">
          <span class="font-weight-bolder mr-1">{{ data.item.sales+'%' }}</span>
          <feather-icon
            :icon="data.item.loss ? 'TrendingDownIcon':'TrendingUpIcon'"
            :class="data.item.loss ? 'text-danger':'text-success'"
          />
        </div>
      </template> -->
    </b-table>
  </b-card>
</template>

<script>
import {
  BCard, BTable, BAvatar, BImg,
} from 'bootstrap-vue'

export default {
  components: {
    BCard,
    BTable,
    BAvatar,
    BImg,
  },
  props: {
    tableData: {
      type: Array,
      default: () => [],
    },
    total_stats: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      fields: [
        { key: 'company', label: 'No' },
        { key: 'category', label: 'Name' },
        { key: 'views', label: 'Client' },
        { key: 'revenue', label: 'Amount' },
        // { key: 'sales', label: 'SALES' },
      ],
    }
  },
}
</script>

<style lang="scss" scoped>
@import '~@resources/scss/base/bootstrap-extended/include';
@import '~@resources/scss/base/components/variables-dark';

.card-company-table ::v-deep td .b-avatar.badge-light-company {
  .dark-layout & {
    background: $theme-dark-body-bg !important;
  }
}
</style>
