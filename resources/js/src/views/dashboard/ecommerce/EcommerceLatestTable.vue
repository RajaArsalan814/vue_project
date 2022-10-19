<template>

  <b-card
    v-if="total_stats"
    no-body
    class="card-company-table"
  >

    <b-table
      :items="total_stats.latest_booked_classes"
      responsive
      :fields="fields"
      class="mb-0"
    >
      <!-- company -->
      <template #cell(company)="data">

            <div class="font-weight-bolder">
              {{ data.item.classes.class_id }}
            </div>
      </template>


      <!-- views -->
      <template #cell(views)="data">

            <div class="font-weight-bolder">
              {{ data.item.classes.type }}
            </div>
      </template>

      <!-- revenue -->
      <template #cell(revenue)="data">
        <!-- {{ '$'+data.item.revenue }} -->
        <div class="font-weight-bolder">
              {{ data.item.time_slot }}
            </div>


      </template>


      <template #cell(another_one)="data">
        <!-- {{ '$'+data.item.revenue }} -->
        <div class="font-weight-bolder">
              {{ data.item.modules.title }}
            </div>
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
        { key: 'company', label: 'Class Id' },
        { key: 'views', label: 'Class Type' },
        { key: 'revenue', label: 'Date And Time' },
        { key: 'another_one', label: 'Module' },
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
