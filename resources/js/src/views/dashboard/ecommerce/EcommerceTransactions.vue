<template>
  <b-card
    v-if="data"
    class="card-transaction"
    no-body
  >
    <b-card-header>
      <b-card-title>Latest Tokens Purchased</b-card-title>

      <!-- <b-dropdown
        variant="link"
        no-caret
        class="chart-dropdown"
        toggle-class="p-0"
        right
      >
        <template #button-content>
          <feather-icon
            icon="MoreVerticalIcon"
            size="18"
            class="text-body cursor-pointer"
          />
        </template>
        <b-dropdown-item href="#">
          Last 28 Days
        </b-dropdown-item>
        <b-dropdown-item href="#">
          Last Month
        </b-dropdown-item>
        <b-dropdown-item href="#">
          Last Year
        </b-dropdown-item>
      </b-dropdown> -->
    </b-card-header>

    <b-card-body>
      <div
        v-for="transaction in total_stats.latest_token_purchases"
        :key="transaction.mode"
        class="transaction-item"
      >
        <b-media no-body>
          <!-- <b-media-aside>
            <b-avatar
              rounded
              size="42"
              :variant="transaction.avatarVariant"
            >
              <feather-icon
                size="18"
                :icon="transaction.avatar"
              />
            </b-avatar>
          </b-media-aside> -->
          <b-media-body>
            <h6 class="transaction-title">
              {{ transaction.user.username }}
            </h6>
          </b-media-body>
        </b-media>
        <div
          class="font-weight-bolder"
        >
          {{ transaction.token_amount }}
        </div>
      </div>
    </b-card-body>
  </b-card>
</template>

<script>
import {
  BCard, BCardHeader, BCardTitle, BCardBody, BMediaBody, BMedia, BMediaAside, BAvatar, BDropdown, BDropdownItem,
} from 'bootstrap-vue'

export default {
  components: {
    BCard,
    BCardHeader,
    BCardTitle,
    BCardBody,
    BMediaBody,
    BMedia,
    BMediaAside,
    BAvatar,
    BDropdown,
    BDropdownItem,
  },
  props: {
    data: {
      type: Array,
      default: () => [],
    },
    total_stats:"",
  },
}
</script>
