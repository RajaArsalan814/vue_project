<template>
  <b-card
    v-if="data"
    no-body
    class="card-statistics"
  >
    <b-card-header>
      <b-card-title>Statistics</b-card-title>
      <b-card-text class="font-small-2 mr-25 mb-0">
        Updated 2 month ago
      </b-card-text>
    </b-card-header>
    <b-card-body class="statistics-body">
      <b-row>
        <b-col

        >
          <b-media no-body>
            <b-media-aside

              class="mr-2"
            >
              <b-avatar
                size="48"
                variant="light-primary"
              >
                <feather-icon
                  size="24"
                  icon="UserIcon"
                />
              </b-avatar>
            </b-media-aside>
            <b-media-body class="my-auto">
              <h4 class="font-weight-bolder mb-0">
                    {{total_stats.teachers}}
              </h4>
              <b-card-text class="font-small-3 mb-0">
                 Teachers
              </b-card-text>
            </b-media-body>
          </b-media>
        </b-col>

        <b-col


        >
          <b-media no-body>
            <b-media-aside

              class="mr-2"
            >
              <b-avatar
                size="48"
                variant="light-primary"
              >
                <feather-icon
                  size="24"
                  icon="UserIcon"
                />
              </b-avatar>
            </b-media-aside>
            <b-media-body class="my-auto">
              <h4 class="font-weight-bolder mb-0">
                {{total_stats.students}}
              </h4>
              <b-card-text class="font-small-3 mb-0">
                     Students
              </b-card-text>
            </b-media-body>
          </b-media>
        </b-col>

        <b-col


        >
          <b-media no-body>
            <b-media-aside

              class="mr-2"
            >
              <b-avatar
                size="48"
                variant="light-primary"
              >
                <feather-icon
                  size="24"
                  icon="UserIcon"
                />
              </b-avatar>
            </b-media-aside>
            <b-media-body class="my-auto">
              <h4 class="font-weight-bolder mb-0">
                {{total_stats.parents}}
              </h4>
              <b-card-text class="font-small-3 mb-0">
                 Parents
              </b-card-text>
            </b-media-body>
          </b-media>
        </b-col>


        <b-col
        >
          <b-media no-body>
            <b-media-aside

              class="mr-2"
            >
              <b-avatar
                size="48"
                variant="light-primary"
              >
                <feather-icon
                  size="24"
                  icon="UserIcon"
                />
              </b-avatar>
            </b-media-aside>
            <b-media-body class="my-auto">
              <h4 class="font-weight-bolder mb-0">
                {{total_stats.agents}}
              </h4>
              <b-card-text class="font-small-3 mb-0">
                 Agents
              </b-card-text>
            </b-media-body>
          </b-media>
        </b-col>

      </b-row>
    </b-card-body>
  </b-card>
</template>

<script>
import {
  BCard, BCardHeader, BCardTitle, BCardText, BCardBody, BRow, BCol, BMedia, BMediaAside, BAvatar, BMediaBody,
} from 'bootstrap-vue'

export default {
  components: {
    BRow,
    BCol,
    BCard,
    BCardHeader,
    BCardTitle,
    BCardText,
    BCardBody,
    BMedia,
    BAvatar,
    BMediaAside,
    BMediaBody,
  },
  props: {
    data: {
      type: Array,
      default: () => [],
    },
    total_stats:""
  },
}
</script>
